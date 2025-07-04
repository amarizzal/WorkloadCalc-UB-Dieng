<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTindakanPerawatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_tindakan_perawat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Menggunakan kolom biasa
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('shift_id');
            $table->unsignedBigInteger('tindakan_id');
            $table->date('tanggal');
            $table->timestamp('jam_mulai');
            $table->timestamp('jam_berhenti')->nullable();
            $table->integer('durasi')->nullable(); // Durasi dalam menit
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('laporan_tindakan_perawat');
    }
}
