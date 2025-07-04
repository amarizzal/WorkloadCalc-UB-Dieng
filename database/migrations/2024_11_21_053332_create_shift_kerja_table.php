<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftKerjaTable extends Migration
{
    public function up()
    {
        Schema::create('shift_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_shift'); // Contoh: "Siang", "Malam"
            $table->time('jam_mulai');    // Waktu mulai shift
            $table->time('jam_selesai');  // Waktu selesai shift
            $table->date('tanggal');      // Tanggal shift
            $table->timestamps();        // Created at, Updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('shift_kerja');
    }
}
