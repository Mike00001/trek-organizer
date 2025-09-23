<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GpxFile;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    public function show()
    {
        // Récupérer les fichiers GPX de l'utilisateur
        $userGpxFiles = auth()->user()->gpxFiles;

        // Récupérer les fichiers GPX communs depuis le dossier public
        $commonGpxFiles = Storage::disk('public')->files('gpx/common'); // Chemin vers les fichiers communs

        // Passer les variables à la vue
        return view('map', compact('userGpxFiles', 'commonGpxFiles'));
    }
}
