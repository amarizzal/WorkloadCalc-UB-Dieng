<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanWaktu extends Model
{
    use HasFactory;

    protected $table = 'tindakan_waktu';

    protected $fillable = [
        'tindakan',
        'waktu',
        'status', // Tambahkan status di sini
        'satuan',
        'kategori'
    ];


    public function laporanTindakan()
    {
        return $this->hasMany(LaporanTindakanPerawat::class, 'tindakan_id', 'id');
    }
}
