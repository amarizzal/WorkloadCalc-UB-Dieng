<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTanggalFromShiftKerja extends Migration
{
    public function up()
    {
        Schema::table('shift_kerja', function (Blueprint $table) {
            $table->dropColumn('tanggal');  // Menghapus kolom tanggal
        });
    }

    public function down()
    {
        Schema::table('shift_kerja', function (Blueprint $table) {
            $table->date('tanggal');  // Jika rollback, tambahkan kolom tanggal lagi
        });
    }
}
