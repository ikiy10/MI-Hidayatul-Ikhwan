<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrKehadiran;
use Carbon\Carbon;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;


class LaporanController extends Controller
{
    // Menampilkan halaman laporan
    public function index(Request $request)
    {
        $absensis = $this->filterAbsensi($request)->orderByDesc('waktu_scan')->get();
        return view('admin.laporan.laporan_absensi', compact('absensis'));
    }

    // Mengekspor laporan ke Excel
    public function exportExcel(Request $request)
    {
        $absensis = $this->filterAbsensi($request)->orderByDesc('waktu_scan')->get();

        $filename = 'laporan_absensi_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new AbsensiExport($absensis), $filename);
    }


    // Fungsi reusable untuk filter data absensi
    private function filterAbsensi(Request $request)
    {
        $query = QrKehadiran::with(['user', 'jadwal']);

        if ($request->kelas) {
            $query->whereHas('jadwal', fn($q) => $q->where('kelas', $request->kelas));
        }

        if ($request->ruang) {
            $query->whereHas('jadwal', fn($q) => $q->where('ruangan', $request->ruang));
        }

        if ($request->mapel) {
            $query->whereHas('jadwal', fn($q) => $q->where('mata_pelajaran', $request->mapel));
        }

        if ($request->hari) {
            $query->whereHas('jadwal', fn($q) => $q->where('hari', $request->hari));
        }

        if ($request->tanggal) {
            try {
                $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal);
                $query->whereDate('waktu_scan', $tanggal);
            } catch (\Exception $e) {
                // Invalid date format
            }
        }

        if ($request->jam) {
            try {
                $jam = Carbon::createFromFormat('H:i', $request->jam);
                $start = $jam->copy()->subMinutes(15)->format('H:i:s');
                $end   = $jam->copy()->addMinutes(15)->format('H:i:s');

                $query->whereHas('jadwal', function ($q) use ($start, $end) {
                    $q->whereBetween('mulai', [$start, $end]);
                });
            } catch (\Exception $e) {
                // Format jam salah
            }
        }

        return $query;
    }
}
