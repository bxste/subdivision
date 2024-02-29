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
        Schema::table('homeowners', function (Blueprint $table) {
            $table->unsignedBigInteger('homeowner_id')->nullable();
            $table->foreign('homeowner_id')->references('id')->on('homeowners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homeowners', function (Blueprint $table) {
            //
        });
    }
};
