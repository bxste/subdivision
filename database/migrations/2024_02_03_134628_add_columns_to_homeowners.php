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
    Schema::table('homeowners', function (Blueprint $table) {
        $table->string('gender');
        $table->string('payment_status');
        $table->string('violation');
    });
}

public function down()
{
    Schema::table('homeowners', function (Blueprint $table) {
        $table->dropColumn(['gender', 'payment_status', 'violation']);
    });
}
};
