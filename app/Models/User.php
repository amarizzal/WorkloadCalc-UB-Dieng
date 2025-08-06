<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // Jika Anda menggunakan notifikasi

class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable, Notifiable;

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'role',
        'foto',
        'nomor_telepon',
        'jenis_kelamin_id',
        'ruangan_id',
        'usia',
        'lama_bekerja',
        'posisi',
        'pendidikan',
        'level',
        'status',
        'tanggal_lahir', // Tambahkan tanggal_lahir
    ];

    protected $hidden = [
        'password', // Pastikan password disembunyikan
        'remember_token', // Jika menggunakan remember me
    ];

    /**
     * Relasi ke model JenisKelamin
     */

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value; // Simpan tanggal lahir
    }

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id');
    }

    /**
     * Relasi ke model Ruangan
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    /**
     * Set password dengan bcrypt
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // app/Models/User.php
    public function laporanTindakan()
    {
        return $this->hasMany(LaporanTindakanPerawat::class, 'user_id', 'id');
    }
}
