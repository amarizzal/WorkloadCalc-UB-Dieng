<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftKerja extends Model
{
    use HasFactory;

    protected $table = 'shift_kerja'; // Pastikan nama tabelnya benar
    protected $fillable = ['nama_shift', 'jam_mulai', 'jam_selesai'];


    public function laporanTindakan()
    {
        return $this->hasMany(LaporanTindakanPerawat::class, 'shift_id', 'id');
    }
}
