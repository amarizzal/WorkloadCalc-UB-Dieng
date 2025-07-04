<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ruangan')->insert([
            ['nama_ruangan' => 'R.Yohanes'],
            ['nama_ruangan' => 'R.Marta'],
            ['nama_ruangan' => 'R.Ana'],
            ['nama_ruangan' => 'R.Theresia'],
        ]);
    }
}
