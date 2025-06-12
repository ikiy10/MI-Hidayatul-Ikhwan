<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';

    protected $fillable = [
        'mata_pelajaran',
        'ruangan',
        'hari',
        'nama_guru',
        'mulai',
        'berakhir',
        'kelas',
    ];

}