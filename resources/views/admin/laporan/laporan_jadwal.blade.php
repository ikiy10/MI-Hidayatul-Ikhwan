@extends('layouts.admin')

@section('title', 'Laporan Jadwal')

@section('content')
<div class="max-w-7xl mx-auto py-6 space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-yellow-300 to-yellow-500 text-black font-semibold text-2xl rounded-t-lg px-8 py-6 shadow-lg flex items-center justify-center space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 text-black">
            <path stroke-linecap="round" stroke-linejoin="round" d="..." />
        </svg>
        <span>Laporan Jadwal Pelajaran</span>
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-6 rounded-b-md shadow-md border border-gray-200">
        <form method="GET" action="{{ route('jadwal.laporan') }}" class="space-y-4 md:space-y-0 md:flex md:items-end md:gap-4 mb-6 flex-wrap">
            <!-- Kelas -->
            <div class="w-full md:w-1/3">
                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select name="kelas" id="kelas" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Semua Kelas --</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                            Kelas {{ $kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Ruangan -->
            <div class="w-full md:w-1/3">
                <label for="ruangan" class="block text-sm font-medium text-gray-700 mb-1">Ruang</label>
                <select name="ruangan" id="ruangan" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Semua Ruang --</option>
                    @foreach ($ruangList as $ruang)
                        <option value="{{ $ruang }}" {{ request('ruangan') == $ruang ? 'selected' : '' }}>
                            Ruang {{ $ruang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition">
                    🔍 Cari
                </button>
               <a href="{{ route('jadwal.export', request()->query()) }}" class="w-full md:w-auto flex justify-center items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition">
                    📥 Cetak Excel
                </a>
            </div>
        </form>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
        @endif

        <!-- Table Responsive -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="border p-2 text-sm">No</th>
                        <th class="border p-2 text-sm">Hari</th>
                        <th class="border p-2 text-sm">Kelas</th>
                        <th class="border p-2 text-sm">Ruang</th>
                        <th class="border p-2 text-sm">Mata Pelajaran</th>
                        <th class="border p-2 text-sm">Guru</th>
                        <th class="border p-2 text-sm">Jam</th>
                        <th class="border p-2 text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwal as $i => $j)
                        <tr>
                            <td class="border p-2 text-center text-sm">{{ $i + 1 }}</td>
                            <td class="border p-2 text-center text-sm">{{ ucfirst($j->hari) }}</td>
                            <td class="border p-2 text-center text-sm">{{ $j->kelas }}</td>
                            <td class="border p-2 text-center text-sm">{{ $j->ruangan }}</td>
                            <td class="border p-2 text-sm">{{ $j->mata_pelajaran }}</td>
                            <td class="border p-2 text-sm">{{ $j->nama_guru }}</td>
                            <td class="border p-2 text-center text-sm">
                                {{ \Carbon\Carbon::parse($j->mulai)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($j->berakhir)->format('H:i') }}
                            </td>
                            <td class="border p-2 text-center text-sm">
                                <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">Tidak ada data jadwal ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
