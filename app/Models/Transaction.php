<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Ajout des champs dans fillable pour permettre l'assignation de masse
    protected $fillable = [
        'montant', 
        'description', 
        'type', 
        'budget_id', 
        'utilisateur_id'
    ];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}

