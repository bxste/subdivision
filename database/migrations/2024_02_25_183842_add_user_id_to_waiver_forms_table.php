<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToWaiverFormsTable extends Migration
{
    public function up()
    {
        Schema::table('waiver_forms', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->default(0); // Change 0 to the default user ID if applicable
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('waiver_forms', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
