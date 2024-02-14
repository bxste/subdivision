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
        $table->string('name');
        $table->string('email');
        $table->string('phone');
    });
}

public function down()
{
    Schema::table('residents', function (Blueprint $table) {
        $table->dropColumn(['name', 'email', 'phone']);
    });
}
};
