<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QrJadwalPelajaran;
use App\Models\QrKehadiran;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function form()
    {
        return view('user.absensi');
    }

    public function submit(Request $request)
    {
        $qr = QrJadwalPelajaran::where('kode_unik', $request->kode_unik)->first();

        if (!$qr) {
            return response()->json([
                'status' => 'error',
                'message' => 'QR tidak valid.'
            ], 404);
        }

        // Cek apakah QR dibuat hari ini
        $tanggalQR = Carbon::parse($qr->created_at)->toDateString();
        $tanggalHariIni = Carbon::today()->toDateString();

        if ($tanggalQR !== $tanggalHariIni) {
            return response()->json([
                'status' => 'expired',
                'message' => 'QR ini sudah kadaluarsa dan tidak berlaku untuk hari ini.'
            ], 403);
        }

        // Cek apakah user sudah absen
        $sudahAbsen = QrKehadiran::where('user_id', auth()->id())
            ->where('qr_jadwal_pelajaran_id', $qr->id)
            ->exists();

        if ($sudahAbsen) {
            return response()->json([
                'status' => 'duplicate',
                'message' => 'Kamu sudah melakukan absensi sebelumnya.'
            ], 400);
        }

        // Simpan kehadiran
        QrKehadiran::create([
            'user_id' => auth()->id(),
            'qr_jadwal_pelajaran_id' => $qr->id,
            'waktu_scan' => now(),
            'status_kehadiran' => 'hadir',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Absensi berhasil. Terima kasih!'
        ]);
    }
}
