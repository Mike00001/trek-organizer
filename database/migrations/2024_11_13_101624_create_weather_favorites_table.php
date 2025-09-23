<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherFavoritesTable extends Migration
{
    public function up()
    {
        Schema::create('weatherFavorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur
            $table->string('city'); // Nom de la ville
            $table->string('country')->nullable(); // Pays de la ville
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('weatherFavorites');
    }
}
