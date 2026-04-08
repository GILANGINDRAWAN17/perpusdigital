<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjaman Buku</title>
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
                <h1 class="text-2xl font-bold text-gray-800">Riwayat Peminjaman Buku</h1>
                <p class="text-gray-500 text-sm mt-1">Berikut Daftar Riwayat Peminjaman Buku Anda</p>
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
            <div class="relative flex-1 max-w-md shadow-sm">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                <input type="text" placeholder="Cari buku..."
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border-none focus:ring-2 focus:ring-[#004d4d] outline-none">
            </div>

            <button
                class="bg-[#004d4d] px-6 py-3.5 rounded-xl text-white font-semibold shadow-sm flex items-center gap-2 hover:brightness-105 transition">
                Status <i data-lucide="chevron-down" class="w-4 h-4"></i>
            </button>

            <button
                class="bg-[#004d4d] px-10 py-3.5 rounded-xl text-white font-bold shadow-sm hover:bg-[#003d3d] transition">
                Cari
            </button>
        </div>

        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[500px]">

            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Dipinjam</h3>
            </div>

            <div class="flex-1 flex flex-col">
                <div class="grid grid-cols-6 bg-[#004d4d] py-4 px-8 text-white font-bold text-center text-sm">
                    <div>Cover</div>
                    <div>Judul</div>
                    <div>Pinjam</div>
                    <div>Kembali</div>
                    <div>Status</div>
                    <div>Aksi</div>
                </div>

                <div class="flex-1 flex flex-col items-center">
                    @php
                        $dipinjam = $data->whereIn('status', ['pending', 'dipinjam', 'menunggu_kembali', 'terlambat']);
                    @endphp

                    @if ($dipinjam->count())
                        @foreach ($dipinjam as $item)
                            <div class="grid grid-cols-6 items-center px-8 py-4 border-b text-center text-sm">

                                {{-- COVER --}}
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/' . $item->buku->cover_image) }}"
                                        class="w-12 h-16 object-cover rounded">
                                </div>

                                {{-- JUDUL --}}
                                <div>{{ $item->buku->judul_buku }}</div>

                                {{-- PINJAM --}}
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</div>

                                {{-- KEMBALI --}}
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}</div>

                                {{-- STATUS --}}
                                <div>
                                    @if ($item->status == 'pending')
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    @elseif ($item->status == 'dipinjam')
                                        <span class="text-green-500 font-semibold">Dipinjam</span>
                                    @elseif ($item->status == 'menunggu_kembali')
                                        <span class="text-blue-500 font-semibold">Menunggu</span>
                                    @elseif ($item->status == 'terlambat')
                                        <span class="text-red-500 font-semibold">Terlambat</span>
                                    @endif
                                </div>

                                {{-- AKSI --}}
                                <div>
                                    @if ($item->status == 'dipinjam')
                                        <form action="{{ route('kembalikan.buku', $item->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm font-medium transition-all duration-300">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @elseif ($item->status == 'terlambat')
                                        <button onclick="openDenda({{ $item->denda }})"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 font-medium rounded text-sm transition-all duration-300">
                                            Detail
                                        </button>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="flex-1 flex flex-col items-center justify-center p-20">
                            <p class="text-slate-500 text-center font-medium">
                                Anda belum memiliki riwayat peminjaman buku. <br>
                                <a href="katalog" class="text-[#004d4d] underline hover:text-[#003d3d]">(Pinjam dari
                                    katalog)</a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>


        </section>

        <section
            class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[500px] mt-10">

            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Dikembalikan</h3>
            </div>

            <div class="flex-1 flex flex-col">
                <div class="grid grid-cols-6 bg-[#004d4d] py-4 px-8 text-white font-bold text-center text-sm">
                    <div>Cover</div>
                    <div>Judul</div>
                    <div>Pinjam</div>
                    <div>Kembali</div>
                    <div>Status</div>
                    <div>Aksi</div>
                </div>

                <div class="flex-1 flex flex-col items-center justify-center p-20">
                    @php
                        $selesai = $data->where('status', 'selesai');
                    @endphp

                    @if ($selesai->count())
                        @foreach ($selesai as $item)
                            <div class="grid grid-cols-6 items-center px-8 py-4 border-b text-center text-sm">

                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/' . $item->buku->cover_image) }}"
                                        class="w-12 h-16 object-cover rounded">
                                </div>

                                <div>{{ $item->buku->judul_buku }}</div>

                                <div>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</div>

                                <div>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</div>

                                <div>
                                    <span class="text-gray-500 font-semibold">Selesai</span>
                                </div>

                                <div>
                                    @if ($item->denda > 0)
                                        <span class="text-red-500 font-semibold">
                                            Rp {{ number_format($item->denda) }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="flex-1 flex flex-col items-center justify-center p-20">
                            <p class="text-slate-500 text-center font-medium">
                                Anda belum memiliki riwayat pengembalian buku.
                            </p>
                        </div>
                    @endif
                </div>
            </div>


        </section>
    </main>

    <div id="modalDenda" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[999]">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">

            <h2 class="text-lg font-bold mb-3 text-[#004d4d]">Detail Denda</h2>

            <p class="text-gray-600 mb-2">
                Total Denda:
            </p>

            <p id="jumlahDenda" class="text-2xl font-bold text-red-500 mb-4">
                Rp 0
            </p>

            <p class="text-sm text-gray-500 mb-6">
                Silahkan datang ke perpustakaan untuk membayar denda.
            </p>

            <div class="text-right">
                <button onclick="closeDenda()" class="bg-[#004d4d] text-white px-4 py-2 rounded">
                    Tutup
                </button>
            </div>

        </div>
    </div>

    @include('layout.notifikasi')

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();

        function openDenda(denda) {
            const modal = document.getElementById('modalDenda');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('jumlahDenda').innerText =
                'Rp ' + new Intl.NumberFormat('id-ID').format(denda);
        }

        function closeDenda() {
            document.getElementById('modalDenda').classList.add('hidden');
        }
    </script>
</body>

</html>
