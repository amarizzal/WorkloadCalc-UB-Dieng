<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE laporan_tindakan_perawat MODIFY durasi DECIMAL(8,2) NULL;');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE laporan_tindakan_perawat MODIFY durasi INT NULL;');
    }
};
