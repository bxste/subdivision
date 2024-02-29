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
        Schema::create('homeowner_archives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homeowner_id')->nullable();
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
            $table->string('disability');
            $table->string('gender');
            $table->string('payment_status');
            $table->string('violation');
            $table->string('relationship_to_homeowner')->nullable();        
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homeowner_archives');
    }
};
