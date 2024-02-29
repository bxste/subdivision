<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pets_archives', function (Blueprint $table) {
            $table->string('email')->nullable(); // Adjust the column type as needed
        });

        // Add column to vehicles_archive
        Schema::table('vehicles_archives', function (Blueprint $table) {
            $table->string('email')->nullable(); // Adjust the column type as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets_archive_and_vehicles_archive', function (Blueprint $table) {
            //
        });
    }
};
