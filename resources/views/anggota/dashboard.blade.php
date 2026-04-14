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

@include('layout.loading')

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

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
            <div
                class="flex items-center gap-5 p-7 bg-white hover:bg-gray-50 rounded-2xl shadow-sm border border-gray-100 hover:scale-[1.01] hover:shadow-lg transition-all duration-500">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-[#004d4d]/10 text-[#004d4d]">
                    <i data-lucide="book-open-check" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-md font-medium text-gray-800 leading-none mb-2">Buku Dipinjam</p>
                    <span class="text-3xl font-bold text-[#004d4d]">{{ $dipinjam }}</span>
                </div>
            </div>


            {{-- JATUH TEMPO --}}
            @php
                $isJatuhTempo = $jatuhTempo > 0;
            @endphp

            <div
                class="flex items-center gap-5 p-7 rounded-2xl shadow-sm border transition-all duration-300
                   {{ $isJatuhTempo ? 'bg-yellow-50 border-yellow-200' : 'bg-white border-gray-100 hover:bg-gray-50' }} 
                    hover:scale-[1.01] hover:shadow-lg">

                <!-- ICON -->
                <div
                    class="flex items-center justify-center w-16 h-16 rounded-2xl
                      {{ $isJatuhTempo ? 'bg-yellow-100 text-yellow-500' : 'bg-[#004d4d]/10 text-[#004d4d]' }}">
                    <i data-lucide="alarm-clock-check" class="w-8 h-8"></i>
                </div>

                <!-- TEXT -->
                <div>
                    <p class="text-md font-medium text-gray-800 mb-1">
                        Jatuh Tempo
                    </p>

                    @php
                        $warna = $isJatuhTempo ? 'text-yellow-500' : 'text-[#004d4d]';
                    @endphp

                    <span class="text-3xl font-bold {{ $warna }}">
                        {{ $jatuhTempo }}
                    </span>

                    {{-- KETERANGAN --}}
                    @if ($isJatuhTempo)
                        <p class="text-yellow-500 text-xs mt-2 font-medium">
                            ⚠ Ada buku yang jatuh tempo
                        </p>
                    @endif
                </div>

            </div>


            {{-- DENDA --}}
            @php
                $isDenda = $denda > 0;
            @endphp

            <div
                class="flex items-center gap-5 p-7 rounded-2xl shadow-sm border transition-all duration-500 hover:scale-[1.01] hover:shadow-lg
                 {{ $isDenda ? 'bg-red-50 border-red-200' : 'bg-white border-gray-100' }}">
                <div
                    class="flex items-center justify-center w-16 h-16 rounded-2xl 
                      {{ $isDenda ? 'bg-red-100 text-red-500' : 'bg-[#004d4d]/10 text-[#004d4d]' }}">
                    <i data-lucide="circle-dollar-sign" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-md font-medium text-gray-800 leading-none mb-2">Denda</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-sm font-bold {{ $denda > 0 ? 'text-red-500' : 'text-[#004d4d]' }}">
                            Rp.
                        </span>
                        <span class="text-3xl font-bold {{ $denda > 0 ? 'text-red-500' : 'text-[#004d4d]' }}">
                            {{ number_format($denda) }}
                        </span>
                    </div>
                    @if ($denda > 0)
                        <p class="text-red-500 text-xs mt-4 leading-snug font-medium hover:underline">
                            ⚠ Silahkan datang ke perpustakaan <br> untuk membayar denda.
                        </p>
                    @endif
                </div>
            </div>



            <div
                class="flex items-center gap-5 p-7 bg-white hover:bg-gray-50 rounded-2xl shadow-sm border border-gray-100 hover:scale-[1.01] hover:shadow-lg transition-all duration-500">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-[#004d4d]/10 text-[#004d4d]">
                    <i data-lucide="history" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-md font-medium text-gray-800 leading-none mb-2">Riwayat Peminjaman</p>
                    <span class="text-3xl font-bold text-[#004d4d]">{{ $riwayat }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">

            <div class="lg:col-span-2 space-y-6">
                <section class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden min-h-[220px]">
                    <div class="p-4 flex justify-between items-center border-b border-gray-50">
                        <h2 class="font-bold text-gray-700">Buku Dipinjam</h2>
                        <a href="/riwayat" class="text-[#004d4d] text-xs font-semibold hover:underline">Lihat
                            Selengkapnya</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#004d4d] text-white font-bold text-sm">
                                <tr>
                                    <th class="px-6 py-3 text-center">Cover</th>
                                    <th class="px-6 py-3 text-center">Judul Buku</th>
                                    <th class="px-6 py-3 text-center">Jatuh Tempo</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bukuDipinjam as $item)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">

                                        <!-- COVER -->
                                        <td class="px-6 py-3 text-center">
                                            <img src="{{ asset('storage/' . $item->buku->cover_image) }}"
                                                class="w-10 h-14 rounded object-cover mx-auto">
                                        </td>

                                        <!-- JUDUL -->
                                        <td class="px-6 py-3 text-center truncate">
                                            {{ $item->buku->judul_buku }}
                                        </td>

                                        <!-- JATUH TEMPO -->
                                        <td class="px-6 py-3 text-center">
                                            {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                        </td>

                                        <!-- STATUS -->
                                        <td class="px-6 py-3 text-center">
                                            @if ($item->status == 'dipinjam')
                                                <span class="text-green-500 font-semibold">Dipinjam</span>
                                            @elseif ($item->status == 'terlambat')
                                                <span class="text-red-500 font-semibold">Terlambat</span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">
                                            Tidak ada data buku yang dipinjam.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden min-h-[220px]">
                    <div class="p-4 flex justify-between items-center border-b border-gray-50">
                        <h2 class="font-bold text-gray-700">Aktivitas Terbaru</h2>
                        <a href="/riwayat" class="text-[#004d4d] text-xs font-semibold hover:underline">Lihat
                            Selengkapnya</a>
                    </div>
                    <div class="px-6 py-6 space-y-3">
                        @forelse ($aktivitas as $item)
                            <div class="flex justify-between text-sm border-b pb-2">
                                <span>{{ $item->buku->judul_buku }}</span>
                                <span class="text-gray-400">
                                    {{ $item->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center text-gray-400 italic">
                                Belum ada aktivitas terbaru.
                            </div>
                        @endforelse
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
