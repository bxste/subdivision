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
        Schema::table('homeowner_pets', function (Blueprint $table) {
            $table->string('breed');
            $table->string('vaccinated');
            $table->string('age');
            $table->string('color');
        });
    }
    
    public function down()
    {
        Schema::table('homeowner_pets', function (Blueprint $table) {
            $table->dropColumn(['sticker_number','color']);
        });
    }
};
