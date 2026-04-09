<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>
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
                <h1 class="text-2xl font-bold text-gray-800">Pengembalian Buku</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola Pengembalian Buku</p>
            </div>

        </header>


        <div class="flex gap-4 mb-10">
            <div class="relative flex-1 max-w-xs shadow-sm">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                <input type="text" placeholder="Cari pengembalian buku..."
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border-none focus:ring-2 focus:ring-[#004d4d] outline-none shadow-md">
            </div>

            <button
                class="bg-[#004d4d] px-6 py-3.5 rounded-xl text-white font-semibold shadow-sm flex items-center gap-2 hover:brightness-105 transition">
                Status <i data-lucide="chevron-down" class="w-4 h-4"></i>
            </button>

            <button
                class="bg-[#004d4d] px-10 py-3.5 rounded-xl text-white font-bold shadow-sm hover:bg-[#003d3d] transition-all duration-300">
                Cari
            </button>
        </div>

        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[500px]">

            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Daftar Buku Dikembalikan</h3>
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
                    @if ($data->count())
                        @foreach ($data as $item)
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
                                    @if ($item->status == 'menunggu_kembali')
                                        <span class="text-blue-500 font-semibold">Menunggu Konfirmasi</span>
                                    @elseif ($item->status == 'terlambat')
                                        <span class="text-red-500 font-semibold">Terlambat</span>
                                    @endif
                                </div>

                                {{-- AKSI --}}
                                <div>
                                    <form action="{{ route('confirm.kembali', $item->id) }}" method="POST">
                                        @csrf
                                        <button
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded text-sm font-medium transition">
                                            Konfirmasi
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="flex-1 flex items-center justify-center p-20">
                            <p class="text-gray-500">Belum ada pengembalian buku</p>
                        </div>
                    @endif
                </div>

            </div>

            <div class="h-8 bg-white border-t border-gray-50"></div>
        </section>


    </main>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>


</body>

</html>
