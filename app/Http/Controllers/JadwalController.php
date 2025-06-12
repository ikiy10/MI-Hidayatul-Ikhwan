<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Exports\JadwalExport;
use Maatwebsite\Excel\Facades\Excel;

class JadwalController extends Controller
{
    /**
     * Simpan data jadwal ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas'         => 'required',
            'ruang'         => 'required',
            'hari'          => 'required',
            'mapel'         => 'required',
            'guru'          => 'required',
            'jam_mulai'     => 'required|date_format:H:i',
            'jam_selesai'   => 'required|date_format:H:i|after:jam_mulai',
        ], [
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
        ]);

        JadwalPelajaran::create([
            'kelas'           => $request->kelas,
            'ruangan'         => $request->ruang,
            'hari'            => strtolower($request->hari),
            'mata_pelajaran'  => $request->mapel,
            'nama_guru'       => $request->guru,
            'mulai'           => $request->jam_mulai,
            'berakhir'        => $request->jam_selesai,
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil disimpan!');
    }

    /**
     * Laporan jadwal (admin) + filter + hapus
     */
    public function laporan(Request $request)
    {
        $query = JadwalPelajaran::query();

        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        if ($request->filled('ruangan')) {
            $query->where('ruangan', $request->ruangan);
        }

        $jadwal = $query
            ->orderByRaw("FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu')")
            ->orderBy('mulai')
            ->get();

        $kelasList = JadwalPelajaran::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');
        $ruangList = JadwalPelajaran::select('ruangan')->distinct()->orderBy('ruangan')->pluck('ruangan');

        return view('admin.laporan.laporan_jadwal', compact('jadwal', 'kelasList', 'ruangList'));
    }

    /**
     * Laporan jadwal untuk user (siswa) - hanya lihat
     */
    public function laporanUser(Request $request)
    {
        $query = JadwalPelajaran::query();

        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        if ($request->filled('ruangan')) {
            $query->where('ruangan', $request->ruangan);
        }

        $jadwal = $query
            ->orderByRaw("FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu')")
            ->orderBy('mulai')
            ->get();

        $kelasList = JadwalPelajaran::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');
        $ruangList = JadwalPelajaran::select('ruangan')->distinct()->orderBy('ruangan')->pluck('ruangan');

        return view('user.jadwal', compact('jadwal', 'kelasList', 'ruangList'));
    }

    /**
     * Hapus data jadwal
     */
    public function destroy($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }

    /**
     * Export jadwal ke file excel
     */
    public function export(Request $request)
    {
        $kelas = $request->kelas;
        $ruangan = $request->ruangan;

        return Excel::download(new JadwalExport($kelas, $ruangan), 'jadwal_pelajaran.xlsx');
    }
}
