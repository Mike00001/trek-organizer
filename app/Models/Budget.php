<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    // Définir les attributs qui peuvent être assignés en masse
    protected $fillable = ['nom', 'createur_id'];  // Ajoute 'nom' à la liste des attributs remplissables

    // Relation avec l'utilisateur qui crée le budget
    public function createur()
    {
        return $this->belongsTo(User::class, 'createur_id');
    }

    // Relation avec les participants
    public function participants()
    {
        return $this->belongsToMany(User::class, 'budget_user');
    }

    // Relation avec les transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
