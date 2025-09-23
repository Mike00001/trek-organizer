<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trek extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 
        'name', 
        'start_date', 
        'end_date', 
        'location', 
        'description', 
        'gpx_file_id'  // Ajout de la clé étrangère pour la relation GPX
    ];

    // Relation avec le modèle GpxFile
    public function gpxFile()
    {
        return $this->belongsTo(GpxFile::class, 'gpx_file_id');
    }
}
