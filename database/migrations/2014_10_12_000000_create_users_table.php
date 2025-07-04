<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');        // Kolom nama lengkap
            $table->string('username')->unique();  // Kolom username
            $table->string('email')->unique();     // Kolom email
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');            // Kolom password
            $table->string('role')->default('perawat'); // Default role perawat
            $table->string('foto')->nullable();    // Kolom foto untuk menyimpan path foto
            $table->string('nomor_telepon');       // Kolom nomor telepon
            $table->unsignedBigInteger('jenis_kelamin_id'); // Kolom jenis kelamin_id
            $table->unsignedBigInteger('ruangan_id');        // Kolom ruangan_id
            $table->integer('usia')->nullable();   // Kolom usia
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
