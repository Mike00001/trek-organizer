<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Backpack;
use Illuminate\Http\Request;

class BackpackController extends Controller
{
    // Afficher la liste des sacs à dos de l'utilisateur connecté
   public function index(Request $request)
{
    $search = $request->input('search', '');
    $user = auth()->user();
    $backpacks = $user ? $user->backpacks : collect();
    $items = $user ? $user->items()->where(function($query) use ($search) {
        $query->where('marque', 'like', "%$search%")
              ->orWhere('modele', 'like', "%$search%")
              ->orWhere('lieu_achat', 'like', "%$search%");
    })->get() : collect();

    $itemCount = $items->count();
    $message = $backpacks->count() == 0 ? 'Vous n\'avez actuellement aucun sac à dos. Créez-en un maintenant !' : null;

    // Calcul des sommes pour tous les backpacks
    $backpacks->each(function ($backpack) {
        $backpack->totalCapacity = $backpack->items->sum('volume');
        $backpack->totalWeight = $backpack->items->sum('poids');
    });

    return view('backpack.index', compact('backpacks', 'itemCount', 'message', 'items', 'search'));
}


    // Afficher le formulaire pour créer un nouveau sac à dos
    public function create()
    {
        // Récupérer les items de l'utilisateur connecté pour pouvoir les ajouter au sac à dos
        $items = auth()->user()->items;
        return view('backpack.create-backpack', compact('items'));
    }

    // Enregistrer un nouveau sac à dos avec les items sélectionnés et une image
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'items' => 'required|array|min:1', // L'utilisateur doit sélectionner au moins un item
            'items.*' => 'exists:items,id',    // Vérifier que chaque item existe
            'name' => 'required|string|max:255', // Le nom du sac
            'image' => 'nullable|image|max:2048', // L'image est optionnelle, max 2MB
            'saison' => 'required|string|in:été,hiver,mi-saison,4-saisons', // Correctement orthographié
            'type' => 'required|string|in:trek_bivouac,trek_gite,randonnée,escalade,trail',
        ]);

        // Création du sac à dos
        $backpack = new Backpack();
        $backpack->name = $request->name;
        $backpack->user_id = auth()->id(); // Associer l'utilisateur au sac à dos
        $backpack->saison = $request->saison; // Ajouter la saison
        $backpack->type = $request->type; // Ajouter le type

        // Sauvegarder l'image si elle est présente
        if ($request->hasFile('image')) {
            $backpack->image = $request->file('image')->store('backpacks', 'public');
        }

        $backpack->save(); // Sauvegarder le sac à dos dans la base de données

        // Attacher les items sélectionnés au sac à dos
        $backpack->items()->attach($request->items);

        return redirect()->route('backpack.index')->with('success', 'Le sac à dos a été créé avec succès!');
    }

    // Afficher un sac à dos spécifique et ses items
    public function show(Backpack $backpack)
    {
        // Vérifier si l'utilisateur est bien propriétaire du sac à dos
        if ($backpack->user_id !== auth()->id()) {
            return redirect()->route('backpack.index')->with('error', 'Accès non autorisé.');
        }

        // Charger les items associés au sac à dos
        $backpack->load('items');

        // Calculer la somme des capacités et des poids des items
        $totalCapacity = $backpack->items->sum('volume');
        $totalWeight = $backpack->items->sum('poids');

        return view('backpack.show', compact('backpack', 'totalCapacity', 'totalWeight'));
    }

    // edition des items
    public function edit(Backpack $backpack)
    {
        // Vérifier si l'utilisateur est bien propriétaire du sac à dos
        if ($backpack->user_id !== auth()->id()) {
            return redirect()->route('backpack.index')->with('error', 'Accès non autorisé.');
        }

        // Récupérer tous les items de l'utilisateur connecté pour permettre la modification
        $items = auth()->user()->items;
        return view('backpack.edit', compact('backpack', 'items'));
    }

    //edition backpack
    public function editBackpack(Backpack $backpack)
    {
        // Vérifier si l'utilisateur est bien propriétaire du sac à dos
        if ($backpack->user_id !== auth()->id()) {
            return redirect()->route('backpack.index')->with('error', 'Accès non autorisé.');
        }
    
        // Récupérer tous les items de l'utilisateur connecté pour permettre la modification
        $items = auth()->user()->items;
        
        // Transmettre le backpack et les items à la vue
        return view('backpack.edit-backpack', compact('backpack', 'items'));
    }

    // update items
    public function update(Request $request, Backpack $backpack)
    {
        // Vérifier si l'utilisateur est bien propriétaire du sac à dos
        if ($backpack->user_id !== auth()->id()) {
            return redirect()->route('backpack.index')->with('error', 'Accès non autorisé.');
        }

        // Validation des données
        $validated = $request->validate([
            'items' => 'required|array|min:1', // Au moins un item doit être sélectionné
            'items.*' => 'exists:items,id',    // Vérifier l'existence des items
            'name' => 'required|string|max:255', // Le nom du sac
            'image' => 'nullable|image|max:2048', // L'image est optionnelle, max 2MB
            'saison' => 'required|string|in:été,hiver,mi-saison,4 saisons', // Validation pour saison
            'type' => 'required|string|in:Trek & bivouac,Trek & gite,Randonnée,Escalade,Trail', // Validation pour type
        ]);

        // Mise à jour du nom du sac à dos
        $backpack->name = $request->name;
        $backpack->saison = $request->saison; // Mise à jour de la saison
        $backpack->type = $request->type; // Mise à jour du type

        // Mise à jour de l'image si une nouvelle image est téléchargée
        if ($request->hasFile('image')) {
            $backpack->image = $request->file('image')->store('backpacks', 'public');
        }

        $backpack->save(); // Sauvegarder les modifications

        // Mise à jour des items du sac à dos
        $backpack->items()->sync($request->items); // Remplacer les items existants par les nouveaux

        return redirect()->route('backpack.index')->with('success', 'Sac à dos mis à jour avec succès!');
    }

    //update backpack
    public function updateBackpack(Request $request, Backpack $backpack)
{
    // Vérifier si l'utilisateur est bien propriétaire du sac à dos
    if ($backpack->user_id !== auth()->id()) {
        return redirect()->route('backpack.index')->with('error', 'Accès non autorisé.');
    }

    // Validation des données
    $validated = $request->validate([
        'items' => 'required|array|min:1',
        'items.*' => 'exists:items,id',
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
        'saison' => 'required|string|in:été,hiver,mi-saison,4 saisons',
        'type' => 'required|string|in:trek_bivouac,trek_gite,randonnée,escalade,trail',
    ]);

    // Mettre à jour le backpack avec les données validées
    $backpack->name = $validated['name'];
    $backpack->saison = $validated['saison'];
    $backpack->type = $validated['type'];

    // Mise à jour de l'image si une nouvelle image est téléchargée
    if ($request->hasFile('image')) {
        $backpack->image = $request->file('image')->store('backpacks', 'public');
    }

    $backpack->save();

    // Mise à jour des items du sac à dos
    $backpack->items()->sync($validated['items']);

    // Redirection avec un message de succès
    return redirect()->route('backpack.index')->with('success', 'Sac à dos mis à jour avec succès!');
}


    // Supprimer un sac à dos
    public function destroy(Backpack $backpack)
    {
        // Vérifier si l'utilisateur est bien propriétaire du sac à dos
        if ($backpack->user_id !== auth()->id()) {
            return redirect()->route('backpack.index')->with('error', 'Accès non autorisé.');
        }

        // Supprimer le sac à dos et ses items associés
        $backpack->delete();

        return redirect()->route('backpack.index')->with('success', 'Sac à dos supprimé avec succès!');
    }

  

}
