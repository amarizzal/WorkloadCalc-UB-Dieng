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
        Schema::create('record_analisa_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Perawat yang dianalisis
            $table->date('tanggal_awal');               // Tanggal analisis
            $table->date('tanggal_akhir');               // Tanggal analisis
            $table->decimal('total_waktu_kerja', 10, 6)->nullable(); // Jam total kerja
            $table->decimal('beban_kerja', 10, 6)->nullable();        // Beban kerja (bisa persen/durasi)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_analisa_data');
    }
};
