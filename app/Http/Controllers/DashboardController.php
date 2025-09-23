<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimplePie;
use Illuminate\Support\Facades\Cache;
use App\Models\WeatherFavorite;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Services\GeoService;

class DashboardController extends Controller
{
    protected $geoService;

    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }

    public function index()
    {
        // Vérifier si les articles sont déjà en cache
        $items = Cache::remember('dashboard_feed_items', 3600, function () {
            $feed = new SimplePie();
            $feed->set_feed_url('https://www.i-trekkings.net/feed/');
            $feed->set_cache_location(storage_path('app/simplepie/cache'));
            $feed->set_cache_duration(3600); // Durée de cache de SimplePie en secondes (1 heure)
            $feed->init();
            
            // Récupérer et limiter les articles à 6 éléments
            return array_slice($feed->get_items(), 0, 6);
        });

        // Récupérer les lieux favoris de l'utilisateur authentifié
        $favorites = WeatherFavorite::where('user_id', Auth::id())->get();

        // Initialiser le client HTTP
        $client = new Client();
        
        // Tableau pour stocker les prévisions météo
        $weatherData = [];

        foreach ($favorites as $favorite) {
            $coordinates = $this->geoService->geocode($favorite->city);

            if ($coordinates && $coordinates->count() > 0) {
                $latitude = $coordinates->first()->getCoordinates()->getLatitude();
                $longitude = $coordinates->first()->getCoordinates()->getLongitude();

                // Appel API pour récupérer les prévisions météo
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

                    $weatherData[$favorite->id] = json_decode($response->getBody(), true);
                } catch (\Exception $e) {
                    \Log::error('Erreur lors de l\'appel à l\'API météo pour ' . $favorite->city . ': ' . $e->getMessage());
                    $weatherData[$favorite->id] = null;  // En cas d'erreur, pas de données météo
                }
            } else {
                $weatherData[$favorite->id] = null;  // Si les coordonnées sont introuvables
            }
        }

        // Passer les articles RSS, les favoris et les prévisions météo à la vue
        return view('dashboard', [
            'items' => $items,
            'favorites' => $favorites,
            'weatherData' => $weatherData,
        ]);
    }
}
