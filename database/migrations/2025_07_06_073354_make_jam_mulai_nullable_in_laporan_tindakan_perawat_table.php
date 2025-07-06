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
        {
            DB::statement("ALTER TABLE laporan_tindakan_perawat MODIFY jam_mulai TIMESTAMP NULL;");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        {
            DB::statement("ALTER TABLE laporan_tindakan_perawat MODIFY jam_mulai TIMESTAMP NOT NULL;");
        }
    }
};
