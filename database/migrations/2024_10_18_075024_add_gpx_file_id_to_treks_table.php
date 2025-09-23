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
        Schema::table('treks', function (Blueprint $table) {
            $table->unsignedBigInteger('gpx_file_id')->nullable()->after('location');
            $table->foreign('gpx_file_id')->references('id')->on('gpx_files')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('treks', function (Blueprint $table) {
            $table->dropForeign(['gpx_file_id']);
            $table->dropColumn('gpx_file_id');
        });
    }
    
};
