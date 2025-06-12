<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $role;

    public function __construct($role = null)
    {
        $this->role = $role;
    }

    public function collection()
    {
        $query = User::query();

        if ($this->role) {
            $query->where('role', $this->role);
        }

        return $query->get([
            'nama_lengkap',
            'email',
            'no_hp',
            'role',
            'jenis_kelamin',
            'tanggal_lahir',
            'alamat',
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Email',
            'No HP',
            'Role',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Alamat',
        ];
    }
}
