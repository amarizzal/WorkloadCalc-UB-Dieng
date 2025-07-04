<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTambahanToStatusEnumInTindakanWaktuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Menambahkan 'tambahan' ke dalam ENUM kolom 'status'
        DB::statement("ALTER TABLE tindakan_waktu MODIFY COLUMN status ENUM('Tugas Pokok', 'Tugas Penunjang', 'tambahan') DEFAULT 'Tugas Pokok'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Mengembalikan perubahan jika rollback
        DB::statement("ALTER TABLE tindakan_waktu MODIFY COLUMN status ENUM('Tugas Pokok', 'Tugas Penunjang') DEFAULT 'Tugas Pokok'");
    }
}
