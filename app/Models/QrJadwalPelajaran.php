<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrJadwalPelajaran extends Model
{
    use HasFactory;

    protected $table = 'qr_jadwal_pelajaran';

    protected $fillable = [
        'kelas',
        'ruangan',
        'hari',
        'mata_pelajaran',
        'nama_guru',
        'mulai',
        'berakhir',
        'kode_unik'
    ];

    // Relasi ke QrKehadiran
    public function kehadiran()
    {
        return $this->hasMany(QrKehadiran::class, 'qr_jadwal_pelajaran_id');
    }
}
