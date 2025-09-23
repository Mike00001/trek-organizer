<?php

namespace App\Http\Controllers;

use App\Models\GpxFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GpxController extends Controller
{
    public function uploadGpx(Request $request)
    {
        // Validation du fichier GPX
        $request->validate([
            'gpxFile' => 'required|file|mimes:gpx,xml'
        ]);

        // Stockage avec extension .gpx dans le disque 'public'
        $originalName = $request->file('gpxFile')->getClientOriginalName();
        $path = $request->file('gpxFile')->storeAs('gpx', pathinfo($originalName, PATHINFO_FILENAME) . '.gpx', 'public');

        // Enregistrement des informations du fichier dans la base de données
        GpxFile::create([
            'user_id' => auth()->id(),
            'filename' => basename($path),
        ]);

        return redirect()->route('map.show')->with('message', 'Fichier GPX téléchargé avec succès.');
    }

    public function clearGpxFiles()
    {
        // Supprime tous les fichiers du répertoire 'gpx' sur le disque 'public'
        Storage::disk('public')->deleteDirectory('gpx');

        // Supprime toutes les entrées correspondantes dans la base de données
        GpxFile::truncate();

        return redirect()->route('map.show')->with('message', 'Tous les fichiers GPX ont été supprimés.');
    }

    public function download(GpxFile $gpxFile)
    {
        // Vérifier si le fichier existe sur le disque public
        $filePath = storage_path('app/public/gpx/' . $gpxFile->filename);

        if (file_exists($filePath)) {
            // Retourner le fichier à l'utilisateur pour téléchargement
            return response()->download($filePath);
        } else {
            // Si le fichier n'existe pas, afficher une erreur 404
            abort(404, 'Le fichier GPX n\'existe pas.');
        }
    }

    public function delete(GpxFile $gpxFile)
    {
        // Supprimer le fichier du disque
        if (Storage::disk('public')->exists('gpx/' . $gpxFile->filename)) {
            Storage::disk('public')->delete('gpx/' . $gpxFile->filename);
        }

        // Supprimer l'entrée de la base de données
        $gpxFile->delete();

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('map.show')->with('message', 'Fichier GPX supprimé avec succès.');
    }

    public function showCommonGpxFiles()
{
    // Spécifie le dossier où les fichiers GPX communs sont stockés
    $gpxDirectory = storage_path('app/public/gpx/common/'); // Chemin vers le dossier 'common' contenant les fichiers GPX

    // Vérifier si le dossier existe avant de récupérer les fichiers
    if (File::exists($gpxDirectory)) {
        // Récupérer tous les fichiers GPX du dossier
        $gpxFiles = File::files($gpxDirectory);  // Ceci renvoie un tableau d'objets SplFileInfo
    } else {
        $gpxFiles = [];  // Si le dossier n'existe pas, renvoyer un tableau vide
    }

    // Passer les fichiers GPX à la vue
    return view('map', [
        'userGpxFiles' => GpxFile::all(),  // Tous les fichiers GPX de l'utilisateur
        'commonGpxFiles' => $gpxFiles,  // Fichiers GPX communs
    ]);
}


}
