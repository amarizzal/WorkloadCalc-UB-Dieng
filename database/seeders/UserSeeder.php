<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin user
        DB::table('users')->insert([
            'nama_lengkap' => 'Admin Perawat',
            'username' => 'admin',
            'email' => 'admin@perawat.com',
            'password' => Hash::make('admin123'), // Gantilah dengan password yang aman
            'role' => 'admin',
            'foto' => null, // Kosongkan atau sesuaikan dengan path foto
            'nomor_telepon' => '08123456789',
            'jenis_kelamin_id' => 1, // Laki-laki
            'ruangan_id' => 1, // R.Yohanes
            'tanggal_lahir' => Carbon::createFromDate(1993, 5, 10)->toDateString(), // Tanggal lahir admin
        ]);

        // Perawat user
        DB::table('users')->insert([
            'nama_lengkap' => 'Perawat Utama',
            'username' => 'perawat',
            'email' => 'perawat@example.com',
            'password' => Hash::make('perawat123'), // Gantilah dengan password yang aman
            'role' => 'perawat',
            'foto' => null, // Kosongkan atau sesuaikan dengan path foto
            'nomor_telepon' => '08129876543',
            'jenis_kelamin_id' => 2, // Perempuan
            'ruangan_id' => 2, // Contoh Ruangan lain
            'tanggal_lahir' => Carbon::createFromDate(1998, 8, 20)->toDateString(), // Tanggal lahir perawat
        ]);
    }
}
