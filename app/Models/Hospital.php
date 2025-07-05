<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospital';

    protected $fillable = [
        'efektif_hari',
        'libur_nasional',
        'cuti_tahunan',
        'rata_rata_sakit',
        'hari_cuti_lain',
        'jam_efektif',
        'waktu_kerja_tersedia',
    ];
}
