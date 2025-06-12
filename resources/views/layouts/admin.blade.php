<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title') - MI Hidayatul Ikhwan</title>
  <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .rotate-180 {
      transform: rotate(180deg);
    }
    .menu-link:hover {
      background-color: #3b82f6;
      color: #ffffff;
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col justify-between">
      <div>
        <div class="p-4 text-2xl font-bold border-b border-gray-700 flex items-center justify-center gap-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
          </svg>
          ADMIN
        </div>
        <nav class="p-4 space-y-2">
          <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-2 p-2 rounded menu-link transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8h4a2 2 0 012 2v6a2 2 0 01-2 2h-4m-4 0H7a2 2 0 01-2-2v-6a2 2 0 012-2h4" />
            </svg>
            Dashboard
          </a>
          <a href="{{ url('/admin/absensi') }}" class="flex items-center gap-2 p-2 rounded menu-link transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
            </svg>
            Absen
          </a>
          <a href="{{ url('/admin/jadwal') }}" class="flex items-center gap-2 p-2 rounded menu-link transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Jadwal Pelajaran
          </a>
          <a href="{{ url('/admin/users') }}" class="flex items-center gap-2 p-2 rounded menu-link transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
            </svg>
            Users
          </a>

          <!-- Dropdown Laporan -->
          <div>
            <button onclick="toggleLaporanDropdown()" class="w-full text-left p-2 rounded menu-link flex justify-between items-center transition">
              <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3v18h18M9 17V9m4 8v-4m4 4V5" />
                </svg>
                Laporan
              </span>
              <svg id="laporanArrow" class="w-4 h-4 transition-transform transform" xmlns="http://www.w3.org/2000/svg"
                   fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div id="laporanMenu" class="pl-6 mt-1 space-y-1 hidden">
              <a href="{{ url('/admin/laporan/laporan-absensi') }}" class="flex items-center gap-2 p-2 rounded menu-link transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                Laporan Absen
              </a>
              <a href="{{ url('/admin/laporan/laporan-jadwal') }}" class="flex items-center gap-2 p-2 rounded menu-link transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10m-11 4h12M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Laporan Jadwal
              </a>
              <a href="{{ url('/admin/laporan/laporan-users') }}" class="flex items-center gap-2 p-2 rounded menu-link transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                Laporan Data Users
              </a>
            </div>
          </div>
        </nav>
      </div>

      <div class="p-4">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button class="w-full flex items-center justify-center gap-2 bg-red-500 text-white p-2 rounded hover:bg-red-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
            Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-4 overflow-auto space-y-4 bg-gray-70">
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
  </div>

  <script>
    function toggleLaporanDropdown() {
      const menu = document.getElementById('laporanMenu');
      const icon = document.getElementById('laporanArrow');
      menu.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    }
  </script>
</body>
</html>
