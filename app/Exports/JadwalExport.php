<?php

namespace App\Exports;

use App\Models\JadwalPelajaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalExport implements FromCollection, WithHeadings
{
    protected $kelas;
    protected $ruangan;

    public function __construct($kelas = null, $ruangan = null)
    {
        $this->kelas = $kelas;
        $this->ruangan = $ruangan;
    }

    public function collection()
    {
        $query = JadwalPelajaran::query();

        if ($this->kelas) {
            $query->where('kelas', $this->kelas);
        }

        if ($this->ruangan) {
            $query->where('ruangan', $this->ruangan);
        }

        return $query->get([
            'hari', 'kelas', 'ruangan', 'mata_pelajaran', 'nama_guru', 'mulai', 'berakhir'
        ]);
    }

    public function headings(): array
    {
        return [
            'Hari',
            'Kelas',
            'Ruangan',
            'Mata Pelajaran',
            'Guru',
            'Jam Mulai',
            'Jam Selesai',
        ];
    }
}
