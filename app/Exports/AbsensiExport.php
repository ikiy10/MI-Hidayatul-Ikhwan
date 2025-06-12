<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiExport implements FromView
{
    protected $absensis;

    public function __construct($absensis)
    {
        $this->absensis = $absensis;
    }

    public function view(): View
    {
        return view('exports.absensi_excel', [
            'absensis' => $this->absensis
        ]);
    }
}
