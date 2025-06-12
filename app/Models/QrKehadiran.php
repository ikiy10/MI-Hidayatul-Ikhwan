<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class QrKehadiran extends Model
{
    use HasFactory;

    protected $table = 'qr_kehadiran';

    protected $fillable = [
        'user_id',
        'qr_jadwal_pelajaran_id',
        'waktu_scan',
        'status_kehadiran',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Jadwal QR
    public function jadwal()
    {
        return $this->belongsTo(QrJadwalPelajaran::class, 'qr_jadwal_pelajaran_id');
    }

    // Accessor Tanggal
    public function getTanggalAttribute()
    {
        return Carbon::parse($this->waktu_scan)->format('Y-m-d');
    }

    // Accessor Jam Mulai
    public function getJamMulaiAttribute()
    {
        return optional($this->jadwal)->mulai;
    }
}
