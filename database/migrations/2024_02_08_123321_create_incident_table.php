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
        Schema::create('incident', function (Blueprint $table) {
            $table->id();
            $table->string('reporter_first_name'); //reported by
            $table->string('reporter_last_name'); //reported by
            $table->char('reporter_phone_number'); //reported by
            $table->char('reporter_block_num'); //reported by
            $table->date('incident_date'); 
            $table->time('incident_time'); 
            $table->string('location_details');
            $table->longText('incident_details');
            $table->longText('incident_type');
            $table->string('person_behind_incident');
            $table->char('person_behind_incident_block_num'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident');
    }
};
