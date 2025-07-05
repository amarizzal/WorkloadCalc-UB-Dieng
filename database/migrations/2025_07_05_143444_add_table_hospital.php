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
        Schema::create('hospital', function (Blueprint $table) {
            $table->id();
            $table->integer('efektif_hari')->nullable();
            $table->integer('libur_nasional')->nullable();
            $table->integer('cuti_tahunan')->nullable();
            $table->integer('rata_rata_sakit')->nullable();
            $table->integer('hari_cuti_lain')->nullable();
            $table->integer('jam_efektif')->nullable();
            $table->string('waktu_kerja_tersedia')->nullable(); // Menyimpan waktu kerja yang tersedia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital');
    }
};
