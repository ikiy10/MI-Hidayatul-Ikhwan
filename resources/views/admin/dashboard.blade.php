@extends('layouts.admin')

@section('title', 'dashboard')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-8 rounded-2xl shadow-lg animate-fade-in">
        <div class="flex items-center space-x-4">
            <div class="text-4xl">👋</div>
            <div>
                <h1 class="text-3xl font-bold">Halo, {{ Auth::user()->nama_lengkap }}!</h1>
                <h2 class="text-sm mt-1">Selamat datang kembali di dashboard 🎉</h2>
            </div>
        </div>
    </div>

    {{-- Statistik Jumlah Admin & User --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        {{-- Card Admin --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-500 relative overflow-hidden flex items-center space-x-4">
            {{-- Icon Admin (user biasa) --}}
            <div class="text-red-600 w-16 h-16 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>
            {{-- Text --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Admin</h3>
                <p class="text-3xl font-bold text-red-600">{{ $totalAdmin }}</p>
            </div>
        </div>

        {{-- Card User --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-green-500 relative overflow-hidden flex items-center space-x-4">
            {{-- Icon User (multi user) --}}
            <div class="text-green-600 w-16 h-16 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
            </div>
            {{-- Text --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total User</h3>
                <p class="text-3xl font-bold text-green-600">{{ $totalUser }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
