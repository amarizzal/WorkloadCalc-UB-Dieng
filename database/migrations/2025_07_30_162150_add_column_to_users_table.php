<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // tambah usia, lama_bekerja, posisi, pendidikan, level, status
            $table->integer('lama_bekerja')->nullable();
            $table->string('posisi')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('level')->nullable();
            $table->string('status')->nullable();
            $table->integer('usia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('lama_bekerja');
            $table->dropColumn('posisi');
            $table->dropColumn('pendidikan');
            $table->dropColumn('level');
            $table->dropColumn('status');
            $table->dropColumn('usia');
        });
    }
};
