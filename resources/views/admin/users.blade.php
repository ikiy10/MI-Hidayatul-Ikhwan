@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto mt-6">

    {{-- Header tetap kuning --}}
    <div class="bg-gradient-to-r from-yellow-300 to-yellow-500 text-black font-bold text-xl rounded-t-md px-6 py-4 shadow-md flex items-center justify-center space-x-3">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
      </svg>
      <span>Tambah User Baru</span>
    </div>

    {{-- Card Form --}}
    <div class="bg-white rounded-b-md shadow-md p-8 border border-gray-300">

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('nama_lengkap') border-red-500 @enderror">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('email') border-red-500 @enderror">
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('no_hp') border-red-500 @enderror">
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Role</label>
                    <select name="role" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('role') border-red-500 @enderror">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('jenis_kelamin') border-red-500 @enderror">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('tanggal_lahir') border-red-500 @enderror">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Password</label>
                    <input type="password" name="password" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('password') border-red-500 @enderror">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Alamat</label>
                    <textarea name="alamat" rows="3" required
                        class="block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md shadow-md transition duration-300">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
