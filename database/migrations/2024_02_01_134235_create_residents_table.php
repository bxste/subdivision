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
        Schema::create('homeowners', function (Blueprint $table) {
            $table->id();
            $table->string('block');
            $table->string('lot');
            $table->string('street');
            $table->string('first_name');
            $table->string('middle_initial');
            $table->string('last_name');
            $table->string('religion');
            $table->string('email');
            $table->integer('phone_number');
            $table->integer('household_size');
            $table->string('occupation');
            $table->string('status');
            $table->string('acknowledgement_on_community_rules');
            $table->string('tenant');
            $table->string('disability');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homeowners');
    }
};
