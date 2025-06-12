@extends('layouts.user')

@section('title', 'dashboard')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-8 rounded-2xl shadow-lg animate-fade-in">
        <div class="flex items-center space-x-4">
            <div class="text-4xl">👋</div>
            <div>
                <h1 class="text-3xl font-bold">Halo, {{ Auth::user()->nama_lengkap }}  !</h1>
                <p class="text-sm mt-1">Selamat datang kembali di dashboard 🎉</p>
            </div>
        </div>
    </div>
    {{-- Informasi Umum --}}
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 mt-10 rounded">
        <p><strong>📢 Info:</strong> Pastikan selalu menscan absensi setiap mata pelajaran agar data kehadiranmu akurat.</p>
    </div>
</div>
@endsection
