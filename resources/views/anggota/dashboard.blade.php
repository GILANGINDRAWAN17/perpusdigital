<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota</title>
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

    @include('layout.sidebar')

    <main class="flex-1 p-8 overflow-y-auto">

        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><span class="font-light">Halo,</span>
                    {{ Auth::user()->username ?? 'N/A' }}!</h1>
                <p class="text-gray-500 text-sm mt-1">Berikut ringkasan aktivitas perpustakaan anda</p>
            </div>
            <div class="flex items-center gap-4">
                <div x-data="{ open: false }" class="relative">

                    <!-- ICON -->
                    <div @click="open = !open"
                        class="bg-white p-2 rounded-full shadow-sm cursor-pointer border border-gray-100 relative">

                        <i data-lucide="bell" class="w-6 h-6 text-[#004d4d]"></i>

                        <!-- BADGE -->
                        <span id="notif-badge"
                            class="absolute top-0 right-0 bg-red-500 text-white text-[10px] w-4 h-4 items-center justify-center rounded-full border-2 border-white hidden">
                        </span>
                    </div>

                    <!-- DROPDOWN -->
                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-lg border z-[999] overflow-hidden">

                        <div class="p-4 border-b font-semibold text-[#002d2d]">
                            Notifikasi
                        </div>

                        <div id="notif-list" class="max-h-80 overflow-y-auto"></div>

                        <div class="p-3 text-center text-sm text-[#003d3d] hover:bg-gray-50 cursor-pointer">
                            Lihat semua
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-[#004d4d]"><i data-lucide="book-open-check" class="w-10 h-10"></i></div>
                <div>
                    <p class="text-[10px] font-bold text-gray-800 uppercase tracking-wider leading-none mb-1">Buku
                        Dipinjam</p>
                    <span class="text-3xl font-bold text-[#004d4d]">0</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-[#004d4d]"><i data-lucide="alarm-clock-check" class="w-10 h-10"></i></div>
                <div>
                    <p class="text-[10px] font-bold text-gray-800 uppercase tracking-wider leading-none mb-1">Jatuh
                        Tempo</p>
                    <span class="text-3xl font-bold text-[#004d4d]">0</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-[#004d4d]"><i data-lucide="circle-dollar-sign" class="w-10 h-10"></i></div>
                <div>
                    <p class="text-[10px] font-bold text-gray-800 uppercase tracking-wider leading-none mb-1">Denda</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-sm font-bold text-[#004d4d]">Rp</span>
                        <span class="text-3xl font-bold text-[#004d4d]">0</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-[#004d4d]"><i data-lucide="history" class="w-10 h-10"></i></div>
                <div>
                    <p class="text-[10px] font-bold text-gray-800 uppercase tracking-wider leading-none mb-1">Riwayat
                    </p>
                    <span class="text-3xl font-bold text-[#004d4d]">0</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-6">
                <section class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 flex justify-between items-center border-b border-gray-50">
                        <h2 class="font-bold text-gray-700">Buku Dipinjam</h2>
                        <a href="#" class="text-[#004d4d] text-xs font-semibold hover:underline">Lihat
                            Selengkapnya</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] tracking-widest">
                                <tr>
                                    <th class="px-6 py-3 font-medium">Cover</th>
                                    <th class="px-6 py-3 font-medium">Judul Buku</th>
                                    <th class="px-6 py-3 font-medium">Jatuh Tempo</th>
                                    <th class="px-6 py-3 font-medium text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t border-gray-50">
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic font-light">
                                        Tidak ada data buku yang dipinjam.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 flex justify-between items-center border-b border-gray-50">
                        <h2 class="font-bold text-gray-700">Aktivitas Terbaru</h2>
                        <a href="#" class="text-[#004d4d] text-xs font-semibold hover:underline">Lihat
                            Selengkapnya</a>
                    </div>
                    <div class="px-6 py-12 text-center text-gray-400 italic font-light">
                        Belum ada aktivitas terbaru.
                    </div>
                </section>
            </div>

            <div class="space-y-6">
                <section class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 flex justify-between items-center border-b border-gray-50">
                        <h2 class="font-bold text-gray-700 text-sm">Rekomendasi Buku</h2>
                        <a href="#" class="text-[#004d4d] text-[10px] font-semibold hover:underline">Lihat
                            Selengkapnya</a>
                    </div>
                    <div class="px-6 py-20 text-center text-gray-400 italic font-light text-sm">
                        Data kosong
                    </div>
                </section>

                <section class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 flex justify-between items-center border-b border-gray-50">
                        <h2 class="font-bold text-gray-700 text-sm">Catatan Denda</h2>
                        <a href="#" class="text-[#004d4d] text-[10px] font-semibold hover:underline">Lihat
                            Selengkapnya</a>
                    </div>
                    <div class="px-6 py-16 text-center text-gray-400 italic font-light text-sm">
                        Tidak ada denda aktif
                    </div>
                </section>
            </div>

        </div>
    </main>

    @include('layout.notifikasi')

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>

</html>
