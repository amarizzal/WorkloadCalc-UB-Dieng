<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan'; // Nama tabel jika berbeda
    protected $fillable = ['nama_ruangan'];


    public function laporanTindakan()
    {
        return $this->hasMany(LaporanTindakanPerawat::class, 'ruangan_id', 'id');
    }
}


