<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('marque');
            $table->string('modele');
            $table->string('lieu_achat')->nullable();
            $table->decimal('prix_achat', 8, 2)->nullable();
            $table->integer('poids')->nullable(); // en grammes
            $table->decimal('volume', 5, 2)->nullable(); // en litres
            $table->string('photo')->nullable();
            $table->string('objet')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}
