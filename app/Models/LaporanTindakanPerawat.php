<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\LaporanTindakanUpdated;

class LaporanTindakanPerawat extends Model
{
    use HasFactory;

    protected $table = 'laporan_tindakan_perawat';

    protected $fillable = [
        'user_id',
        'ruangan_id',
        'shift_id',
        'tindakan_id',
        'tanggal',
        'jam_mulai',
        'jam_berhenti',
        'durasi',
        'keterangan'
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    // Relasi ke model ShiftKerja
    public function shift()
    {
        return $this->belongsTo(ShiftKerja::class);
    }

    // Relasi ke model TindakanWaktu
    public function tindakan()
    {
        return $this->belongsTo(TindakanWaktu::class);
    }

    // Event trigger
    protected $dispatchesEvents = [
        'updated' => LaporanTindakanUpdated::class,
    ];
}
