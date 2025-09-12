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
        Schema::table('laporan_tindakan_perawat', function (Blueprint $table) {
            $table->string('no_rekam_medis', 50)->nullable()->after('record_analisa_data_id');
            $table->string('nama_pasien', 100)->nullable()->after('no_rekam_medis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_tindakan_perawat', function (Blueprint $table) {
            $table->dropColumn(['no_rekam_medis', 'nama_pasien']);
        });
    }
};
