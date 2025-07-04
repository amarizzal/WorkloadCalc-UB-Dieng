<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TindakanWaktuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['tindakan' => 'Anamnesa', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Pemeriksaan Fisik', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Mengukur TTV', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Menegakkan diagnosa keperawatan', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Rencana Tindakan Keperawatan', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Serah terima pasien baru', 'waktu' => 10, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Menyiapkan alat pemasangan IV Line', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Memasang infus', 'waktu' => 10, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Merawat Infus', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Mengatur tetesan infus', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Mengganti Cairan Infus', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Memperbaiki infus yang macet', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Melepas infus', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Mengambil spesimen darah', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Merawat luka', 'waktu' => 30, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Lavage lambung', 'waktu' => 30, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Pemeriksaan EKG', 'waktu' => 20, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Melakukan injeksi', 'waktu' => 10, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Melakukan suction lendir', 'waktu' => 30, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Menyiapkan O2 ke ruangan pasien', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Memberikan oksiegen', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Membersihkan alat', 'waktu' => 10, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Memasang kateter', 'waktu' => 10, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Melepas kateter', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Melayani nebulizer', 'waktu' => 30, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Membereskan selang nebul dan bereskan alat', 'waktu' => 20, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Pendidikan kesehatan', 'waktu' => 15, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Melakukan Operan', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Melakukan ronde keperawatan', 'waktu' => 30, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Melakukan pencatatan/dokumentasi', 'waktu' => 10, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Observasi/evaluasi', 'waktu' => 5, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Kolaborasi dengan dokter jaga', 'waktu' => 15, 'status' => 'Tugas Penunjang'],
            ['tindakan' => 'Membuat administrasi (billing)', 'waktu' => 15, 'status' => 'Tugas Penunjang'],
            ['tindakan' => 'Mengantar makanan', 'waktu' => 15, 'status' => 'Tugas Penunjang'],
            ['tindakan' => 'Mengantar pemeriksaan diagnostik', 'waktu' => 30, 'status' => 'Tugas Penunjang'],
            ['tindakan' => 'Mengantar pasien rujuk ke rumah sakit', 'waktu' => 360, 'status' => 'Tugas Penunjang'],
            ['tindakan' => 'Mengikuti pertemuan bulanan', 'waktu' => 60, 'status' => 'Tugas Penunjang'],
            ['tindakan' => 'Mengikuti visite dokter', 'waktu' => 5, 'status' => 'Tugas Penunjang'],

            // Menambahkan tindakan "Lain-Lain" dengan status "Tugas Pokok"
            ['tindakan' => 'Lain-Lain', 'waktu' => 0, 'status' => 'Tugas Pokok'],
            ['tindakan' => 'Tugas Tambahan', 'waktu' => 0, 'status' => 'tambahan'],
        ];

        // Menyimpan data ke dalam tabel tindakan_waktu
        DB::table('tindakan_waktu')->insert($data);
    }
}
