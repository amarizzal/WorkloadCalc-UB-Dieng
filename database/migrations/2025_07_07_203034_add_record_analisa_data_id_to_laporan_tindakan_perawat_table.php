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
            $table->unsignedBigInteger('record_analisa_data_id')->nullable()->after('id');

            $table->foreign('record_analisa_data_id')
                ->references('id')
                ->on('record_analisa_data')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::transaction(function () {
            Schema::table('laporan_tindakan_perawat', function (Blueprint $table) {
                $table->dropForeign(['record_analisa_data_id']);
                $table->dropColumn('record_analisa_data_id');
            });
        });
    }
};
