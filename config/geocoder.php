<?php

return [
    'cache' => [
        'store' => null, // Utilise null pour désactiver le cache
        'duration' => 86400, // Durée en secondes
        'enabled' => false, // Passe à true pour activer le cache
    ],

    'providers' => [
        \Geocoder\Provider\Nominatim\Nominatim::class => [
            'https://nominatim.openstreetmap.org',
            'default',
            env('GEOCODER_NOMINATIM_EMAIL', 'votre-email@example.com'), // Remplace avec un email valide pour Nominatim
        ],
    ],

    'adapter'  => \Http\Adapter\Guzzle7\Client::class, // Guzzle HTTP adapter
    'reader'   => null, // Utilisé pour la lecture des fichiers

    'plugins' => [
        // Ici, on peut ajouter des plugins spécifiques, comme le cache, etc.
    ],
];
