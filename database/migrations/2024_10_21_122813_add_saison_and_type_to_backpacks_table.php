<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('backpacks', function (Blueprint $table) {
            $table->string('saison')->after('name'); // Ajoute le champ saison
            $table->string('type')->after('saison'); // Ajoute le champ type
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('backpacks', function (Blueprint $table) {
            $table->dropColumn('saison'); // Supprime le champ saison
            $table->dropColumn('type'); // Supprime le champ type
        });
    }
};
