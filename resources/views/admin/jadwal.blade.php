@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto mt-6">

    {{-- Header tetap kuning --}}
    <div class="bg-gradient-to-r from-yellow-300 to-yellow-500 text-black font-bold text-xl rounded-t-md px-6 py-4 shadow-md flex items-center justify-center space-x-3">
        <!-- Ikon Heroicons di tengah -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25-2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5" />
        </svg>

        <!-- Teks -->
        <span>Tambah Jadwal</span>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Jadwal Berhasil Ditambahkan!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Notifikasi error global --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Terjadi kesalahan:</strong>
            <ul class="mt-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Card Form --}}
    <div class="bg-white rounded-b-md shadow-md p-8 border border-gray-300">
        <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kelas -->
                <div>
                    <label for="kelas" class="block text-sm font-semibold text-gray-800 mb-2">Kelas</label>
                    <select name="kelas" id="kelas" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach (range(1, 6) as $kelas)
                            <option value="{{ $kelas }}" {{ old('kelas') == $kelas ? 'selected' : '' }}>Kelas {{ $kelas }}</option>
                        @endforeach
                    </select>
                    @error('kelas')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ruang -->
                <div>
                    <label for="ruang" class="block text-sm font-semibold text-gray-800 mb-2">Ruang</label>
                    <select name="ruang" id="ruang" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Ruang --</option>
                        @foreach (range('A', 'Z') as $ruang)
                            <option value="{{ $ruang }}" {{ old('ruang') == $ruang ? 'selected' : '' }}>Ruang {{ $ruang }}</option>
                        @endforeach
                    </select>
                    @error('ruang')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hari -->
                <div>
                    <label for="hari" class="block text-sm font-semibold text-gray-800 mb-2">Hari</label>
                    <select name="hari" id="hari" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Hari --</option>
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                            <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                        @endforeach
                    </select>
                    @error('hari')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mata Pelajaran -->
                <div>
                    <label for="mapel" class="block text-sm font-semibold text-gray-800 mb-2">Mata Pelajaran</label>
                    <input type="text" name="mapel" id="mapel" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500" value="{{ old('mapel') }}">
                    @error('mapel')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Guru -->
                <div>
                    <label for="guru" class="block text-sm font-semibold text-gray-800 mb-2">Nama Guru</label>
                    <input type="text" name="guru" id="guru" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500" value="{{ old('guru') }}">
                    @error('guru')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Mulai -->
                <div>
                    <label for="jam_mulai" class="block text-sm font-semibold text-gray-800 mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="jam_mulai" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500" value="{{ old('jam_mulai') }}">
                    @error('jam_mulai')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Selesai -->
                <div>
                    <label for="jam_selesai" class="block text-sm font-semibold text-gray-800 mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500" value="{{ old('jam_selesai') }}">
                    @error('jam_selesai')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md shadow-md">
                💾 Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
