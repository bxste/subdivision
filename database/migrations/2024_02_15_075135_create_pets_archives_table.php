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
        Schema::create('pets_archives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homeowner_id');
            $table->string('type_of_pets');
            $table->string('breed');
            $table->string('vaccinated');
            $table->integer('age');
            $table->string('color');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets_archives');
    }
};
