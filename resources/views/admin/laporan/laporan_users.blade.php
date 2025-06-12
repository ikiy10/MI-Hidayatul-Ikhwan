@extends('layouts.admin')

@section('title', 'Laporan Data User')

@section('content')
<div class="max-w-7xl mx-auto py-6 space-y-6">

    <div class="bg-gradient-to-r from-yellow-300 to-yellow-500 text-black font-semibold text-2xl rounded-t-lg px-8 py-6 shadow-lg flex items-center justify-center space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
        </svg>
        <span>Laporan Data User</span>
    </div>

    <div class="bg-white p-6 rounded-b-md shadow-md border border-gray-200">
        <form method="GET" action="{{ route('user.laporan') }}" class="space-y-4 md:space-y-0 md:flex md:items-end md:gap-6 mb-6">
            <div class="w-full md:w-1/3">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select name="role" id="role" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">-- Semua Role --</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="w-full md:w-auto">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition duration-300">
                    🔍 Cari
                </button>
            </div>
            <a href="{{ route('user.export', ['role' => request('role')]) }}" 
                class="w-full md:w-auto flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition duration-300">
                📥 Cetak Excel
            </a>

        </form>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Nama Lengkap</th>
                        <th class="border p-2">Email</th>
                        <th class="border p-2">No HP</th>
                        <th class="border p-2">Role</th>
                        <th class="border p-2">Jenis Kelamin</th>
                        <th class="border p-2">Tanggal Lahir</th>
                        <th class="border p-2">Alamat</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $i => $user)
                        <tr>
                            <td class="border p-2 text-center">{{ $i + 1 }}</td>
                            <td class="border p-2">{{ $user->nama_lengkap }}</td>
                            <td class="border p-2">{{ $user->email }}</td>
                            <td class="border p-2">{{ $user->no_hp }}</td>
                            <td class="border p-2 text-center capitalize">{{ $user->role }}</td>
                            <td class="border p-2 text-center">{{ $user->jenis_kelamin }}</td>
                            <td class="border p-2 text-center">
                                {{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') }}
                            </td>
                            <td class="border p-2">{{ $user->alamat }}</td>
                            <td class="border p-2 text-center">
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada data user ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
