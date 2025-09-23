<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'modele',
        'lieu_achat',
        'prix_achat',
        'poids',
        'volume',
        'photo',
        'objet',
        'type'
    ];

    // Relation many-to-many avec le modèle Backpack
    public function backpacks()
    {
        return $this->belongsToMany(Backpack::class);
    }
}
