<?php

namespace App\Services;

use Geocoder\Provider\GoogleMaps\GoogleMaps;
use Geocoder\StatefulGeocoder;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use Geocoder\Exception\Exception;
use Illuminate\Support\Facades\Log;

class GeoService
{
    protected $geocoder;

    public function __construct()
    {
        $httpClient = new GuzzleAdapter();

        // Récupère la clé API depuis la configuration
        $apiKey = config('services.google_maps.key');

        // Initialise le fournisseur Google Maps avec la clé API et la langue
        $provider = new GoogleMaps($httpClient, null, config('services.google_maps.key'), 'fr');

        $this->geocoder = new StatefulGeocoder($provider, 'fr'); // 'fr' pour la langue française
    }

    public function geocode(string $city)
    {
        try {
            $result = $this->geocoder->geocodeQuery(\Geocoder\Query\GeocodeQuery::create($city));

            if ($result->isEmpty()) {
                return null; // ou une autre gestion d'erreur
            }

            return $result; // retourne le résultat de géocodage
        } catch (Exception $e) {
            return null;
        }
    }
}
