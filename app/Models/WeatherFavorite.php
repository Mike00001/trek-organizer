<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherFavorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'city', 'country'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
