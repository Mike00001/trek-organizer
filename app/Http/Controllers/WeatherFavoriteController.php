<?php

namespace App\Http\Controllers;

use App\Models\WeatherFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeatherFavoriteController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'city' => 'required|string',
            'country' => 'nullable|string',
        ]);

        // Sauvegarde du lieu favori pour l'utilisateur authentifié
        WeatherFavorite::create([
            'user_id' => Auth::id(),
            'city' => $request->city,
            'country' => $request->country,
        ]);

        // Retour avec un message de succès
        return redirect()->back()->with('success', 'Ville ajoutée aux favoris!');
    }

    public function destroy($id)
    {
        // Trouver le favori par son identifiant
        $favorite = WeatherFavorite::findOrFail($id);
        
        // Supprimer le favori de la base de données
        $favorite->delete();

        // Rediriger vers la page météo avec un message de succès
        return redirect()->route('weather.get')->with('success', 'Favori supprimé avec succès.');
    }
}
