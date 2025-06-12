<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\JadwalPelajaran;
use App\Models\QrJadwalPelajaran;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrAdminController extends Controller
{
    public function form(Request $request)
    {
        return view('admin.absensi', [
            'kelasList' => JadwalPelajaran::select('kelas')->distinct()->pluck('kelas'),
            'ruanganList' => JadwalPelajaran::select('ruangan')->distinct()->pluck('ruangan'),
            'hariList' => JadwalPelajaran::select('hari')->distinct()->pluck('hari'),
            'mapelList' => JadwalPelajaran::select('mata_pelajaran')->distinct()->pluck('mata_pelajaran'),
            'qrCode' => session('last_qr_code') ? QrCode::size(300)->generate(session('last_qr_code')) : null,
            'message' => session('qr_message') ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'ruangan' => 'required',
            'hari' => 'required',
            'mata_pelajaran' => 'required',
        ]);

        $jadwal = JadwalPelajaran::where('kelas', $request->kelas)
            ->where('ruangan', $request->ruangan)
            ->where('hari', $request->hari)
            ->where('mata_pelajaran', $request->mata_pelajaran)
            ->first();

        if (!$jadwal) {
            return redirect()->route('qr.form')->with('error', 'Jadwal tidak ditemukan.');
        }

        // Cek apakah QR sudah dibuat hari ini
        $existing = QrJadwalPelajaran::where([
            ['kelas', $jadwal->kelas],
            ['ruangan', $jadwal->ruangan],
            ['hari', $jadwal->hari],
            ['mata_pelajaran', $jadwal->mata_pelajaran],
        ])->whereDate('created_at', now()->toDateString())->first();

        if ($existing) {
            session([
                'last_qr_code' => $existing->kode_unik,
                'qr_message' => 'QR untuk mata pelajaran ini sudah dibuat hari ini.',
            ]);

            return redirect()->route('qr.form');
        }

        // Buat QR baru
        $kodeUnik = Str::uuid()->toString();

        QrJadwalPelajaran::create([
            'kelas' => $jadwal->kelas,
            'ruangan' => $jadwal->ruangan,
            'hari' => $jadwal->hari,
            'mata_pelajaran' => $jadwal->mata_pelajaran,
            'nama_guru' => $jadwal->nama_guru,
            'mulai' => $jadwal->mulai,
            'berakhir' => $jadwal->berakhir,
            'kode_unik' => $kodeUnik,
        ]);

        session([
            'last_qr_code' => $kodeUnik,
            'qr_message' => 'QR berhasil dibuat.',
        ]);

        return redirect()->route('qr.form');
    }
}
