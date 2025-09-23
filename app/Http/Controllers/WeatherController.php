<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeoService;
use GuzzleHttp\Client;
use App\Models\WeatherFavorite; // Assurez-vous d'avoir le modèle approprié

class WeatherController extends Controller
{
    protected $geoService;

    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }

    public function showWeatherForm()
    {
        // Récupérer les favoris de l'utilisateur connecté (si vous gérez des utilisateurs)
        $weatherFavorites = WeatherFavorite::all(); // Vous pouvez filtrer selon l'utilisateur connecté si nécessaire, ex: ->where('user_id', auth()->id())

        // Passer les favoris à la vue
        return view('weather.form', compact('weatherFavorites'));
    }

    public function getWeather(Request $request)
    {
        // Valider la présence du champ "city"
        $request->validate([
            'city' => 'required|string',
        ]);
    
        $city = $request->input('city');
    
        // Convertir le nom de la ville en latitude et longitude
        $coordinates = $this->geoService->geocode($city);

        if (!$coordinates || $coordinates->isEmpty()) {
            return back()->withErrors(['error' => 'Lieu introuvable, veuillez essayer avec un autre nom.']);
        }

        $latitude = $coordinates->first()->getCoordinates()->getLatitude();
        $longitude = $coordinates->first()->getCoordinates()->getLongitude();

        // Récupérer le pays à partir du géocodage ou d'un autre service
        // Supposons que le pays est inclus dans les données retournées par le service de géocodage
        $country = $coordinates->first()->getCountry() ?: 'France';  // Si le pays n'est pas trouvé, on prend la France par défaut

        $client = new Client();

        try {
            $response = $client->get("https://api.open-meteo.com/v1/forecast", [
                'query' => [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'current_weather' => true,
                    'daily' => 'temperature_2m_max,temperature_2m_min,precipitation_sum,weathercode,sunrise,sunset',
                    'timezone' => 'Europe/Paris'
                ]
            ]);

            $weatherData = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'appel à l\'API météo : ' . $e->getMessage());
            return back()->withErrors(['error' => 'Erreur lors de l\'appel à l\'API météo.']);
        }

        if (!isset($weatherData['current_weather'])) {
            return back()->withErrors(['error' => 'Données météo introuvables.']);
        }

        // Récupérer les favoris après avoir récupéré les données météo
        $weatherFavorites = WeatherFavorite::all(); // Vous pouvez ajuster cette ligne selon vos besoins

        // Passer la ville, le pays, les données météo et les favoris à la vue
        return view('weather.result', compact('weatherData', 'city', 'country', 'weatherFavorites'));
    }

    // Méthode pour afficher la page de détails d'une ville
    public function show($id)
    {
        // Récupérer le favori en fonction de l'ID
        $favorite = WeatherFavorite::findOrFail($id);

        // Convertir la ville en latitude et longitude
        $coordinates = $this->geoService->geocode($favorite->city);

        if (!$coordinates || $coordinates->isEmpty()) {
            return back()->withErrors(['error' => 'Lieu introuvable, veuillez essayer avec un autre nom.']);
        }

        $latitude = $coordinates->first()->getCoordinates()->getLatitude();
        $longitude = $coordinates->first()->getCoordinates()->getLongitude();

        $client = new Client();

        try {
            $response = $client->get("https://api.open-meteo.com/v1/forecast", [
                'query' => [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'current_weather' => true,
                    'daily' => 'temperature_2m_max,temperature_2m_min,precipitation_sum,weathercode,sunrise,sunset',
                    'timezone' => 'Europe/Paris'
                ]
            ]);

            $weatherData = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'appel à l\'API météo : ' . $e->getMessage());
            return back()->withErrors(['error' => 'Erreur lors de l\'appel à l\'API météo.']);
        }

        if (!isset($weatherData['current_weather'])) {
            return back()->withErrors(['error' => 'Données météo introuvables.']);
        }

        // Passer les données météo et le favori à la vue de détails
        return view('weather.details', compact('favorite', 'weatherData'));
    }
}
