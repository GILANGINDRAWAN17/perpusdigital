<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#E2EDED] min-h-screen flex">

    <aside class="w-64 bg-[#004d4d] text-white flex flex-col sticky top-0 h-screen shrink-0">
        <div class="p-8 flex items-center mx-auto gap-3">
            <i data-lucide="book-open" class="w-8 h-8"></i>
            <span class="text-2xl font-bold tracking-tight">Pustaka</span>
        </div>

        <div
            class="bg-[#003d3d] scale-90 border border-[#027676] px-4 py-3 flex rounded-lg items-center gap-3 cursor-pointer shadow-2xl">
            <div class="w-10 h-10 bg-white rounded-full shadow-inner flex items-center justify-center text-white">
                <i data-lucide="user-round" class="w-5 h-5 text-[#004d4d]"></i>
            </div>
            <div class="ml-1 min-w-0">
                <p class="font-semibold text-md capitalize truncate">
                    {{ Auth::user()->username ?? 'N/A' }}
                </p>
                <p class="font-light text-sm capitalize">
                    {{ ucwords(str_replace('_', ' ', Auth::user()->role ?? 'N/A')) }}
                </p>
            </div>
        </div>

        <nav class="flex-1 space-y-2 mt-8">
            <a href="dashboardpetugas"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('dashboardpetugas') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>

            <a href="peminjaman"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('peminjaman') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="BookUp" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Peminjaman</span>
            </a>
            <a href="pengembalian"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('pengembalian') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="BookDown" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Pengembalian</span>
            </a>
            <a href="daftarbuku"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('daftarbuku') || request()->routeIs('buku.*') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="book-copy" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Daftar Buku</span>
            </a>
        </nav>

        <div class="mb-6">
            <a href="profilepetugas"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('profilepetugas') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="user" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Profil</span>
            </a>
            <a href="#" onclick="handleLogout()"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:text-white transition-all duration-300 group">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>Logout</span>
            </a>
        </div>

    </aside>

    @include('layout.globalmodal')

    <script>
        lucide.createIcons();

        function handleLogout() {
            openModal(
                "Konfirmasi Logout",
                "Apakah anda yakin ingin keluar?",
                function() {
                    window.location.href = "login";
                }
            );
        }
    </script>

</body>

</html>
