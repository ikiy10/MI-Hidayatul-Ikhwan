@extends('layouts.admin')

@section('title', 'Laporan Absen')

@section('content')
<div class="max-w-7xl mx-auto mt-6 space-y-6">
    <div class="bg-yellow-400 text-gray-900 text-xl font-bold px-6 py-4 rounded-t-md shadow-md flex justify-center items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
        </svg>
        Laporan Absen Siswa
    </div>

    <div class="bg-white p-4 shadow-sm rounded-b-md border border-gray-200">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-8 gap-4">
            <select name="kelas" class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Kelas</option>
                @for ($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}" {{ request('kelas') == $i ? 'selected' : '' }}>Kelas {{ $i }}</option>
                @endfor
            </select>

            <select name="ruang" class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Ruang</option>
                @foreach (range('A','Z') as $ruang)
                    <option value="{{ $ruang }}" {{ request('ruang') == $ruang ? 'selected' : '' }}>Ruang {{ $ruang }}</option>
                @endforeach
            </select>

            <select name="mapel" class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Mata Pelajaran</option>
                @foreach ([
                    'Bahasa Indonesia','Matematika','PPKn','SBdP','PJOK','Bahasa Inggris',
                    'Al-Qur\'an Hadits','Aqidah Akhlak','Fiqih','SKI','Bahasa Arab','Tahfidz','BTQ'
                ] as $mapel)
                    <option value="{{ $mapel }}" {{ request('mapel') == $mapel ? 'selected' : '' }}>{{ $mapel }}</option>
                @endforeach
            </select>

            <select name="hari" class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Hari</option>
                @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                    <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                @endforeach
            </select>

            <select name="jam" class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Jam</option>
                @for ($h = 6; $h <= 17; $h++)
                    <option value="{{ sprintf('%02d:00', $h) }}" {{ request('jam') == sprintf('%02d:00', $h) ? 'selected' : '' }}>{{ sprintf('%02d:00', $h) }}</option>
                    <option value="{{ sprintf('%02d:30', $h) }}" {{ request('jam') == sprintf('%02d:30', $h) ? 'selected' : '' }}>{{ sprintf('%02d:30', $h) }}</option>
                @endfor
            </select>

            <input type="date" name="tanggal" class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500" value="{{ request('tanggal') }}">

            <button type="submit" class="flex items-center justify-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow transition">
                🔍 Cari
            </button>
                <a href="{{ route('laporan.absensi.export.excel', request()->query()) }}"
                class="flex items-center justify-center gap-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow transition">
                    📥 Cetak Excel
                </a>
        </form>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="w-full text-sm text-left border border-gray-200 shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Siswa</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Ruang</th>
                    <th class="px-4 py-2">Mapel</th>
                    <th class="px-4 py-2">Hari</th>
                    <th class="px-4 py-2">Jam</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Waktu Scan</th> {{-- Kolom baru --}}
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white text-gray-700">
                @forelse ($absensis as $absen)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $absen->user->nama_lengkap ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->jadwal->kelas ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->jadwal->ruangan ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->jadwal->mata_pelajaran ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->jadwal->hari ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->jam_mulai ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->tanggal ?? '-' }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($absen->waktu_scan)->format('H:i:s') ?? '-' }}</td> {{-- Waktu scan --}}
                        <td class="px-4 py-2 font-semibold {{ $absen->status_kehadiran === 'hadir' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($absen->status_kehadiran ?? '-') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-gray-500 px-4 py-4">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
