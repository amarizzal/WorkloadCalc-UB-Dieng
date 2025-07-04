<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('tindakan_waktu', function (Blueprint $table) {
            $table->id();
            $table->string('tindakan');
            $table->integer('waktu'); // Waktu dalam menit
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tindakan_waktu');
    }

};
