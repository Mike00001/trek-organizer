<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToBackpacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('backpacks', function (Blueprint $table) {
            $table->string('image')->nullable()->after('name'); // Ajoute une colonne image après le champ name
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('backpacks', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
