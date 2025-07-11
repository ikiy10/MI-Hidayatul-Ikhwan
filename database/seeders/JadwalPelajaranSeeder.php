<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal_pelajaran')->insert([
            [
                'mata_pelajaran' => 'Matematika',
                'ruangan'        => 'A',
                'hari'           => 'Senin',
                'nama_guru'      => 'Budi Santoso S.Pd',
                'mulai'          => '07:00:00',
                'berakhir'       => '08:30:00',
                'kelas'          => '1',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Indonesia',
                'ruangan'        => 'B',
                'hari'           => 'Senin',
                'nama_guru'      => 'Siti Aminah S.pd',
                'mulai'          => '08:30:00',
                'berakhir'       => '10:00:00',
                'kelas'          => '1',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'PPKn',
                'ruangan'        => 'C',
                'hari'           => 'Senin',
                'nama_guru'      => 'Dedi Kurniawan S.pd',
                'mulai'          => '10:15:00',
                'berakhir'       => '11:45:00',
                'kelas'          => '1',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'SBdp',
                'ruangan'        => 'D',
                'hari'           => 'Selasa',
                'nama_guru'      => 'Eka Putri S.pd',
                'mulai'          => '07:00:00',
                'berakhir'       => '08:30:00',
                'kelas'          => '2',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Arab',
                'ruangan'        => 'E',
                'hari'           => 'Selasa',
                'nama_guru'      => 'Ahmad Zulfikar S.pd',
                'mulai'          => '08:30:00',
                'berakhir'       => '10:00:00',
                'kelas'          => '2',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Fiqih',
                'ruangan'        => 'F',
                'hari'           => 'Rabu',
                'nama_guru'      => 'Rina Wahyuni S.pd',
                'mulai'          => '07:00:00',
                'berakhir'       => '08:30:00',
                'kelas'          => '3',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'PJOK',
                'ruangan'        => 'G',
                'hari'           => 'Rabu',
                'nama_guru'      => 'Hendra Saputra S.pd',
                'mulai'          => '08:30:00',
                'berakhir'       => '10:00:00',
                'kelas'          => '3',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Aqidah Akhlak',
                'ruangan'        => 'H',
                'hari'           => 'Rabu',
                'nama_guru'      => 'Dewi Lestari S.pd',
                'mulai'          => '10:15:00',
                'berakhir'       => '11:45:00',
                'kelas'          => '3',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Fiqih',
                'ruangan'        => 'I',
                'hari'           => 'Kamis',
                'nama_guru'      => 'Teguh Prasetyo S.pd',
                'mulai'          => '07:00:00',
                'berakhir'       => '08:30:00',
                'kelas'          => '4',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Inggris',
                'ruangan'        => 'J',
                'hari'           => 'Kamis',
                'nama_guru'      => 'Linda Handayani S.pd',
                'mulai'          => '08:30:00',
                'berakhir'       => '10:00:00',
                'kelas'          => '4',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'SKI',
                'ruangan'        => 'K',
                'hari'           => 'Kamis',
                'nama_guru'      => 'Agus Wijaya S.pd',
                'mulai'          => '10:15:00',
                'berakhir'       => '11:45:00',
                'kelas'          => '4',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'BTQ',
                'ruangan'        => 'L',
                'hari'           => 'Jumat',
                'nama_guru'      => 'Yuniarti S.pd',
                'mulai'          => '07:00:00',
                'berakhir'       => '08:30:00',
                'kelas'          => '5',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Al-Quran Hadits',
                'ruangan'        => 'M',
                'hari'           => 'Jumat',
                'nama_guru'      => 'Budi Santoso S.pd',
                'mulai'          => '08:30:00',
                'berakhir'       => '10:00:00',
                'kelas'          => '5',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Indonesia',
                'ruangan'        => 'N',
                'hari'           => 'Jumat',
                'nama_guru'      => 'Siti Aminah S.pd',
                'mulai'          => '10:15:00',
                'berakhir'       => '11:45:00',
                'kelas'          => '5',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Tahfidz',
                'ruangan'        => 'O',
                'hari'           => 'Senin',
                'nama_guru'      => 'Ust. Fajar S.pd',
                'mulai'          => '11:45:00',
                'berakhir'       => '13:15:00',
                'kelas'          => '6',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Arab',
                'ruangan'        => 'P',
                'hari'           => 'Senin',
                'nama_guru'      => 'Ahmad Zulfikar S.pd',
                'mulai'          => '13:00:00',
                'berakhir'       => '14:30:00',
                'kelas'          => '6',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        ]);
    }
}
