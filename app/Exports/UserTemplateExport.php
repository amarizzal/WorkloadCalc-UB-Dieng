<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserTemplateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Contoh baris data kosong (supaya user tahu format)
        return collect([
            [
                'admin', 'John Doe', 'johndoe', 'john@example.com', '123456', 
                'R.Ana', 'Laki-laki', '08123456789', '1990-01-01', 5, 
                'Supervisor', 'S1', 'Senior', 'Aktif'
            ],
            [
                'perawat', 'John Doe', 'johndoe', 'john@example.com', '123456', 
                'R.Marta', 'Perempuan', '08123456789', '1990-01-01', 5, 
                'Supervisor', 'S1', 'Senior', 'Aktif'
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            'role',
            'nama_lengkap',
            'username',
            'email',
            'password',
            'ruangan_id',
            'jenis_kelamin_id',
            'nomor_telepon',
            'tanggal_lahir (YYYY-MM-DD)',
            'lama_bekerja',
            'posisi',
            'pendidikan',
            'level',
            'status'
        ];
    }
}
