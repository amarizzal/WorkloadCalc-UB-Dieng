<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LaporanTindakanPerawat;

class RecordAnalisaData extends Model
{
    use HasFactory;

    protected $table = 'record_analisa_data';
    protected $fillable = [
        'id',
        'user_id',
        'tanggal_awal',
        'tanggal_akhir',
        'total_waktu_kerja',
        'beban_kerja'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function laporanTindakan()
    {
        return $this->hasMany(LaporanTindakanPerawat::class, 'record_analisa_data_id');
    }
}
