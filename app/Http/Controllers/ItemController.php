<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $items = auth()->user()->items()->where(function($query) use ($search) {
            $query->where('marque', 'like', "%$search%")
                  ->orWhere('modele', 'like', "%$search%")
                  ->orWhere('lieu_achat', 'like', "%$search%");
        })->get();
        
        return view('items.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'objet' => 'nullable|string|max:255',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'lieu_achat' => 'nullable|string|max:255',
            'prix_achat' => 'nullable|numeric',
            'poids' => 'nullable|integer',
            'volume' => 'nullable|numeric',
            'type' => 'required|string|in:Dormir,Manger,Vêtements,Hygiène,Equipement',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        // Gestion du fichier photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
    
        // Création de l'item avec les données validées
        $item = auth()->user()->items()->create([
            'objet' => $validated['objet'],
            'marque' => $validated['marque'],
            'modele' => $validated['modele'],
            'lieu_achat' => $validated['lieu_achat'],
            'prix_achat' => $validated['prix_achat'],
            'poids' => $validated['poids'],
            'volume' => $validated['volume'],
            'photo' => $photoPath,
            'type' => $validated['type'],
        ]);
    
        // Optionnel: associer cet item à un backpack si nécessaire
        if ($request->has('backpacks')) {
            $item->backpacks()->sync($request->input('backpacks'));
        }
    
        // Redirection vers la page principale (backpack.index) après création
        return redirect()->route('backpack.index')->with('success', 'Item ajouté avec succès');
    }
    
    public function show($id)
{
    $item = Item::findOrFail($id); // Fetch the item using the ID
    return view('items.show', compact('item')); // Return the detail view
}



    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
{
    $validated = $request->validate([
        'objet' => 'nullable|string|max:255',
        'marque' => 'required|string|max:255',
        'modele' => 'required|string|max:255',
        'lieu_achat' => 'nullable|string|max:255',
        'prix_achat' => 'nullable|numeric',
        'poids' => 'nullable|integer',
        'volume' => 'nullable|numeric',
        'type' => 'required|string|in:Dormir,Manger,Vêtements,Hygiène,Equipement',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Si vous souhaitez mettre à jour la photo
    ]);

    // Gestion de la mise à jour du fichier photo si nécessaire
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($item->photo) {
            Storage::disk('public')->delete($item->photo);
        }
        // Enregistrer la nouvelle photo
        $validated['photo'] = $request->file('photo')->store('photos', 'public');
    }

    // Mise à jour de l'item
    $item->update($validated);
    
    return redirect()->route('backpack.index')->with('success', 'Item mis à jour avec succès');
    
}


    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index');
    }
}