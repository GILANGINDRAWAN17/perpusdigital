<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
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
                <h1 class="text-2xl font-bold text-gray-800">Pinjaman Buku</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola Peminjaman Buku</p>
            </div>

        </header>


        <div class="flex gap-4 mb-10">
            <div class="relative flex-1 max-w-xs">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                <input type="text" placeholder="Cari pinjaman buku..."
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

        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[400px]">

            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Daftar Buku Dipinjam</h3>
            </div>

            <div class="flex-1 flex flex-col overflow-x-auto">
                <div class="min-w-[1100px]">
                    <div
                        class="sticky grid grid-cols-[80px_200px_160px_120px_120px_120px_120px_120px] bg-[#004d4d] py-4 px-8 text-white font-bold text-center text-sm">
                        <div>Cover</div>
                        <div>Judul</div>
                        <div>Peminjam</div>
                        <div>Pinjam</div>
                        <div>Jatuh Tempo</div>
                        <div>Kembali</div>
                        <div>Status</div>
                        <div>Aksi</div>
                    </div>

                    @if ($data->count())
                        @foreach ($data as $item)
                            <div
                                class="sticky grid grid-cols-[80px_200px_160px_120px_120px_120px_120px_120px] items-center px-8 py-4 border-b text-center text-sm">

                                {{-- COVER --}}
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/' . $item->buku->cover_image) }}"
                                        class="w-12 h-16 object-cover rounded">
                                </div>

                                {{-- JUDUL --}}
                                <div>{{ $item->buku->judul_buku }}</div>

                                <!-- PEMINJAM -->
                                <div class="truncate whitespace-nowrap text-center">
                                    {{ $item->user->username ?? '-' }}
                                </div>

                                {{-- PINJAM --}}
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</div>

                                <!-- JATUH TEMPO -->
                                <div class="text-center">
                                    @if (now()->gt($item->tanggal_jatuh_tempo) && !$item->tanggal_kembali)
                                        <span class="text-red-500 font-semibold">
                                            {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                        </span>
                                    @else
                                        {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                    @endif
                                </div>

                                {{-- KEMBALI --}}
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}</div>

                                {{-- STATUS --}}
                                <div>
                                    @if ($item->status == 'pending')
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    @elseif ($item->status == 'dipinjam')
                                        <span class="text-green-500 font-semibold">Dipinjam</span>
                                    @endif
                                </div>

                                {{-- AKSI --}}
                                <div class="flex gap-2 justify-center">

                                    @if ($item->status == 'pending')
                                        <form action="{{ route('peminjaman.approve', $item->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 font-medium transition-all duration-300 rounded text-sm">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('peminjaman.tolak', $item->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="bg-red-500 hover:bg-red-600 text-white font-medium transition-all duration-300 px-3 py-2 rounded text-sm">
                                                Tolak
                                            </button>
                                        </form>
                                    @else
                                        <span>-</span>
                                    @endif

                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="flex-1 flex items-center justify-center p-20">
                            <p class="text-gray-500">Belum ada data peminjaman</p>
                        </div>
                    @endif
                </div>
            </div>

        </section>


    </main>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>

</html>
