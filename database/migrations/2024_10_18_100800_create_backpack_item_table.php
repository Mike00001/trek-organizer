<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackpackItemTable extends Migration
{
    public function up()
    {
        Schema::create('backpack_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('backpack_id')
                ->constrained('backpacks') // Spécifie explicitement la table 'backpacks'
                ->onDelete('cascade');
            $table->foreignId('item_id')
                ->constrained('items') // Spécifie explicitement la table 'items'
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('backpack_item');
    }
}
