<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUsiaFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('usia');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('usia')->nullable();
        });
    }
}
