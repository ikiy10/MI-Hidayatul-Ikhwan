@extends('layouts.admin')

@section('title', 'QR Absensi')

@section('content')
<div class="container mx-auto px-4 mt-6">
    <div class="bg-yellow-400 text-black p-4 rounded mb-6 flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 4a1 1 0 011-1h3a1 1 0 110 2H5v2a1 1 0 11-2 0V5a1 1 0 010-1zm15-1a1 1 0 011 1v2a1 1 0 11-2 0V5h-2a1 1 0 110-2h3zM4 15a1 1 0 011 1v3h2a1 1 0 110 2H5a1 1 0 01-1-1v-4a1 1 0 011-1zm16 0a1 1 0 011 1v4a1 1 0 01-1 1h-3a1 1 0 110-2h2v-3a1 1 0 011-1z" />
        </svg>
        <h4 class="text-lg font-bold m-0">Buat QR Code Absen</h4>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(isset($message))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded p-6">
        <form action="{{ route('qr.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select name="kelas" required class="w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas }}">{{ $kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ruangan</label>
                <select name="ruangan" required class="w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach ($ruanganList as $ruangan)
                        <option value="{{ $ruangan }}">{{ $ruangan }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                <select name="hari" required class="w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Hari --</option>
                    @foreach ($hariList as $hari)
                        <option value="{{ $hari }}">{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                <select name="mata_pelajaran" required class="w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach ($mapelList as $mapel)
                        <option value="{{ $mapel }}">{{ $mapel }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                    </svg>
                    <span>Buat QR</span>
                </button>
            </div>
        </form>
    </div>

    @if(isset($qrCode))
        <div class="mt-6 flex justify-center">
            <div class="bg-white shadow-md rounded p-6 text-center">
                <h5 class="text-lg font-semibold mb-4">QR Code:</h5>
                <div>{!! $qrCode !!}</div>
            </div>
        </div>
    @endif
</div>
@endsection
