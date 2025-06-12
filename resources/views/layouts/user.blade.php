<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - MI Hidayatul Ikhwan</title>
  <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col justify-between">
      <div>
        <!-- Logo dan Tulisan USER -->
        <div class="p-4 text-2xl font-bold border-b border-gray-700 flex items-center justify-center gap-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
          </svg>
          USER
        </div>

        <!-- Navigasi -->
        <nav class="p-4 space-y-2">
          <a href="{{ url('/user/dashboard') }}" class="flex items-center gap-2 p-2 rounded hover:bg-blue-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8h4a2 2 0 012 2v6a2 2 0 01-2 2h-4m-4 0H7a2 2 0 01-2-2v-6a2 2 0 012-2h4" />
            </svg>
            Dashboard
          </a>

          <a href="{{ url('/user/absensi') }}" class="flex items-center gap-2 p-2 rounded hover:bg-blue-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            Absen
          </a>

          <a href="{{ url('/user/jadwal') }}" class="flex items-center gap-2 p-2 rounded hover:bg-blue-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10m-11 4h12M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Jadwal Pelajaran
          </a>
        </nav>
      </div>

      <!-- Logout -->
      <div class="p-4">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button class="bg-red-500 w-full p-2 rounded hover:bg-red-600 flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
            Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6 overflow-auto">

      {{-- ✅ FLASH MESSAGE --}}
      @if (session('error'))
        <div class="bg-red-500 text-white px-4 py-3 rounded mb-4">
          {{ session('error') }}
        </div>
      @endif

      @if (session('success'))
        <div class="bg-green-500 text-white px-4 py-3 rounded mb-4">
          {{ session('success') }}
        </div>
      @endif

      <!-- Main Content Area -->
      <main class="flex-1 p-3 overflow-auto space-y-3 bg-gray-70">
        <!-- Header -->
        <header class="w-full bg-white shadow rounded-xl px-4 py-2 flex justify-between items-center">
          <div>
            <h2 class="text-xl font-bold text-gray-900 tracking-wide">
              Madrasah Ibtidaiyah <br />
              <span class="text-indigo-600">Hidayatul Ikhwan</span>
            </h2>
          </div>
          <div class="flex items-center space-x-3">
            <img
              src="{{ asset('img/logo.png') }}"
              alt="Logo"
              class="w-13 h-12 rounded-full"
            />
          </div>
        </header>
        <!-- Konten Halaman -->
        @yield('content')
      </main>
    </main>
  </div>

  {{-- ✅ Stack scripts dari child view --}}
  @stack('scripts')
</body>
</html>
