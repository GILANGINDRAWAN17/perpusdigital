<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
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
                <h1 class="text-2xl font-bold text-gray-800">Katalog Buku</h1>
                <p class="text-gray-500 text-sm mt-1">Temukan Buku Favorit Anda</p>
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

        <div class="flex gap-4 mb-10">
            <div class="relative flex-1 max-w-sm shadow-sm">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                <input type="text" placeholder="Cari buku..."
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border-none focus:ring-2 focus:ring-[#004d4d] outline-none">
            </div>
            <button
                class="bg-[#004d4d] p-3.5 rounded-xl text-white shadow-sm hover:bg-[#003d3d] transition-all duration-300">
                <i data-lucide="list-filter" class="w-6 h-6"></i>
            </button>
            <button
                class="bg-[#004d4d] px-10 py-3.5 rounded-xl text-white font-bold shadow-sm hover:bg-[#003d3d] transition-all duration-300">
                Cari
            </button>
        </div>

        <section class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                @foreach ($buku as $item)
                    <div
                        class="bg-white border border-slate-50 p-5 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 flex gap-5 group">

                        {{-- COVER --}}
                        <div
                            class="w-32 h-44 bg-slate-200 rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform duration-300 overflow-hidden">

                            @if ($item->cover_image)
                                <img src="{{ asset('storage/' . $item->cover_image) }}"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>

                        {{-- DETAIL --}}
                        <div class="flex flex-col justify-between flex-1">
                            <div class="space-y-2 text-sm">

                                <p class="text-slate-400 truncate font-medium">
                                    Judul :
                                    <span class="text-slate-700 font-semibold ml-1">
                                        {{ $item->judul_buku }}
                                    </span>
                                </p>

                                <p class="text-slate-400 truncate font-medium">
                                    Penulis :
                                    <span class="text-slate-700 font-semibold ml-1">
                                        {{ $item->penulis }}
                                    </span>
                                </p>

                                <p class="text-slate-400 font-medium">
                                    Tahun :
                                    <span class="text-slate-700 font-semibold ml-1">
                                        {{ \Carbon\Carbon::parse($item->tahun_terbit)->year }}
                                    </span>
                                </p>

                                <p class="text-slate-400 font-medium">
                                    Status :
                                    @if ($item->stock_buku > 0)
                                        <span class="text-teal-500 font-bold ml-1">Tersedia</span>
                                    @else
                                        <span class="text-red-500 font-bold ml-1">Habis</span>
                                    @endif
                                </p>

                            </div>

                            {{-- BUTTON --}}
                            @if ($item->stock_buku > 0)
                                <button
                                    onclick="openModal('Form Peminjaman', 'Silahkan pilih tanggal peminjaman', null, 'pinjam', {{ $item->id }})""
                                    class="bg-[#004d4d] text-white text-xs font-black uppercase tracking-wider py-2.5 px-6 rounded-lg self-start mt-3 hover:bg-[#003d3d] shadow-md shadow-[#004d4d]/20 transition-all duration-300">
                                    Pinjam
                                </button>
                            @else
                                <button
                                    class="bg-gray-400 text-white text-xs font-black uppercase tracking-wider py-2.5 px-6 rounded-lg self-start mt-3 cursor-not-allowed">
                                    Habis
                                </button>
                            @endif

                        </div>
                    </div>
                @endforeach

            </div>

        </section>

    </main>

    @include('layout.notifikasi')

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>

</html>
