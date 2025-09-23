<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backpack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',     // Nom du sac
        'user_id',  // Référence à l'utilisateur propriétaire du sac
        'type',
        'saison',   // Ajoutez cette ligne pour le champ saison
    ];

    // Relation many-to-many avec le modèle Item
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    // Relation one-to-many avec l'utilisateur (un sac appartient à un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
