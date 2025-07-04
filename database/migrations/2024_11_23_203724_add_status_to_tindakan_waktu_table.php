<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTindakanWaktuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tindakan_waktu', function (Blueprint $table) {
            $table->enum('status', ['Tugas Pokok', 'Tugas Penunjang'])->default('Tugas Pokok')->after('waktu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tindakan_waktu', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
    