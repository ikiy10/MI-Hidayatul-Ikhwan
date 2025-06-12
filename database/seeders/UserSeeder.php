<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel users.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama_lengkap' => 'Dabang Karan',
                'email'        => 'Dabang@gmail.com',
                'no_hp'        => '081234567890',
                'password'     => Hash::make('admin123'), // Password: admin123
                'role'         => 'admin',
                'jenis_kelamin'=> 'L',
                'tanggal_lahir'=> '1990-01-01',
                'alamat'       => 'Jl. Admin Raya No. 1',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_lengkap' => 'Rizky Ramadhan',
                'email'        => 'rizky@gmail.com',
                'no_hp'        => '081234567890',
                'password'     => Hash::make('admin123'), // Password: admin123
                'role'         => 'admin',
                'jenis_kelamin'=> 'L',
                'tanggal_lahir'=> '1999-01-01',
                'alamat'       => 'Jl. Admin Raya No. 2',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_lengkap' => 'Ujang Santoso',
                'email'        => 'ujang@gmail.com',
                'no_hp'        => '081298765432',
                'password'     => Hash::make('user123'), // Password: user123
                'role'         => 'user',
                'jenis_kelamin'=> 'P',
                'tanggal_lahir'=> '2000-05-05',
                'alamat'       => 'Jl. Pengguna No. 99',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_lengkap' => 'Dadang Gendang',
                'email'        => 'dadang@gmail.com',
                'no_hp'        => '081298765432',
                'password'     => Hash::make('user123'), // Password: user123
                'role'         => 'user',
                'jenis_kelamin'=> 'P',
                'tanggal_lahir'=> '2000-05-05',
                'alamat'       => 'Jl. Pengguna No. 999',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]
        ]);
    }
}
