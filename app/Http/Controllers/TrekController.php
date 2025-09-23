<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trek;
use Illuminate\Support\Facades\Storage;
use App\Models\GpxFile;


class TrekController extends Controller
{
    public function index()
    {
        $treks = Trek::all();
        return view('treks.index', compact('treks'));
    }

    public function show($id)
    {
        $trek = Trek::findOrFail($id); // Recherche le trek par son ID
        return view('treks.show', compact('trek')); // Passe le trek à la vue
    }


    public function create()
    {
        $gpxFiles = GpxFile::all(); // Récupère tous les fichiers GPX
        return view('treks.create', compact('gpxFiles'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'image' => 'nullable|image',
        'name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'location' => 'required|string|max:255',
        'gpx' => 'nullable|exists:gpx_files,id', // Vérifie que l'ID GPX existe dans la base
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('trek_images', 'public');
    } else {
        $imagePath = null;
    }

    Trek::create([
        'image' => $imagePath,
        'name' => $validated['name'],
        'start_date' => $validated['start_date'],
        'end_date' => $validated['end_date'],
        'location' => $validated['location'],
        'gpx_file_id' => $request->input('gpx'), // Ajout du fichier GPX à l'enregistrement
    ]);

    return redirect()->route('treks.index');
}


    public function edit($id)
    {
        $trek = Trek::findOrFail($id); // Trouve le trek par ID
        return view('treks.edit', compact('trek')); // Retourne la vue 'edit' avec les données du trek
    }

    public function update(Request $request, $id)
    {
        $trek = Trek::findOrFail($id); // Trouve le trek par ID

        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Met à jour les informations du trek
        $trek->name = $request->name;
        $trek->start_date = $request->start_date;
        $trek->end_date = $request->end_date;
        $trek->location = $request->location;
        $trek->description = $request->description;

        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            $trek->image = $request->file('image')->store('treks', 'public');
        }

        $trek->save(); // Sauvegarde les modifications

        return redirect()->route('treks.show', $trek->id)->with('success', 'Trek mis à jour avec succès!');
    }


}
