<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackpacksTable extends Migration
{
    public function up()
    {
        Schema::create('backpacks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du sac
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Référence à l'utilisateur
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('backpacks');
    }
}
