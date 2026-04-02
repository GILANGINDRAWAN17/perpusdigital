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
            class="bg-[#003d3d] scale-90 border border-white flex px-4 py-3 rounded-lg mx-auto items-center gap-3 cursor-pointer">
            <i data-lucide="ContactRound" class="w-5 h-5"></i>
            <span class="font-medium text-sm">Anda Masuk Sebagai :</span>
        </div>

        <nav class="flex-1 space-y-1 mt-8">
            <a href="dashboardpetugas"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:bg-[#003d3d] transition-all group">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="#"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:bg-[#003d3d] transition-all group">
                <i data-lucide="BookUp" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Pengajuan</span>
            </a>
            <a href="#"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:bg-[#003d3d] transition-all group">
                <i data-lucide="BookDown" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Pengembalian</span>
            </a>
            <a href="#"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:bg-[#003d3d] transition-all group">
                <i data-lucide="book-copy" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Daftar Buku</span>
            </a>
        </nav>

        <div class="mb-6">
            <a href="#"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:bg-[#003d3d] transition-all group">
                <i data-lucide="user" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Profil</span>
            </a>
            <a href="#"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:bg-[#003d3d] transition-all group">
                <i data-lucide="log-out" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                <span>Logout</span>
            </a>
        </div>


    </aside>


    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>

</html>
