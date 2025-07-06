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
        Schema::table('tindakan_waktu', function (Blueprint $table) {
            $table->string('satuan')->nullable()->after('waktu');
            $table->string('kategori')->nullable()->after('satuan');
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
            $table->dropColumn(['satuan', 'kategori']);
        });
    }
};
