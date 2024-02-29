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
    Schema::table('residents', function (Blueprint $table) {
        $table->string('gender');
        $table->string('religion');
        $table->integer('num_pets');
        $table->integer('num_vehicles');
        $table->integer('num_tenants');
    });
}

public function down()
{
    Schema::table('residents', function (Blueprint $table) {
        $table->dropColumn(['gender', 'religion', 'num_pets', 'num_vehicles', 'num_tenants']);
    });
}
};
