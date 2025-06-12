@extends('layouts.user')

@section('title', 'Jadwal')

@section('content')
<div class="max-w-7xl mx-auto py-6 space-y-6">
    <div class="bg-gradient-to-r from-yellow-300 to-yellow-500 text-black font-semibold text-2xl rounded-t-lg px-8 py-6 shadow-lg flex items-center justify-center space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 text-black">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
        </svg>
        <span> Jadwal Pelajaran</span>
    </div>

    <div class="bg-white p-6 rounded-b-md shadow-md border border-gray-200 space-y-6">

        {{-- Filter Form --}}
        <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
            <form method="GET" action="{{ route('user.jadwal') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Kelas -->
                <div>
                    <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                    <select name="kelas" id="kelas"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Semua Kelas --</option>
                        @foreach ($kelasList as $kelas)
                            <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>Kelas {{ $kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Ruangan -->
                <div>
                    <label for="ruangan" class="block text-sm font-medium text-gray-700 mb-1">Ruangan</label>
                    <select name="ruangan" id="ruangan"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Semua Ruang --</option>
                        @foreach ($ruangList as $ruang)
                            <option value="{{ $ruang }}" {{ request('ruangan') == $ruang ? 'selected' : '' }}>Ruang {{ $ruang }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex items-end">
                    <button type="submit" class="flex items-center justify-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow transition">
                        🔍 Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        {{-- Tabel Responsif --}}
        <div class="overflow-x-auto rounded-md border border-gray-300">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Hari</th>
                        <th class="border px-4 py-2">Kelas</th>
                        <th class="border px-4 py-2">Ruang</th>
                        <th class="border px-4 py-2">Mata Pelajaran</th>
                        <th class="border px-4 py-2">Guru</th>
                        <th class="border px-4 py-2">Jam</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($jadwal as $i => $j)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2 text-center">{{ $i + 1 }}</td>
                            <td class="border px-4 py-2 text-center">{{ ucfirst($j->hari) }}</td>
                            <td class="border px-4 py-2 text-center">{{ $j->kelas }}</td>
                            <td class="border px-4 py-2 text-center">{{ $j->ruangan }}</td>
                            <td class="border px-4 py-2">{{ $j->mata_pelajaran }}</td>
                            <td class="border px-4 py-2">{{ $j->nama_guru }}</td>
                            <td class="border px-4 py-2 text-center">
                                {{ \Carbon\Carbon::parse($j->mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($j->berakhir)->format('H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data jadwal ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
