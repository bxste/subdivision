<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In the created migration file (e.g., 2024_01_27_create_properties_table.php)
    public function up()
        {
            Schema::create('properties', function (Blueprint $table) {
                $table->id();
                $table->string('address');
                $table->string('type');
                $table->string('purchased_date');
                $table->unsignedBigInteger('resident_id');
                $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
                $table->timestamps();
            });
        }

    public function down()
        {
            Schema::dropIfExists('properties');
        }

};
