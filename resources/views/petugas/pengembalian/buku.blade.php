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

@include('layout.loading')

<body class="bg-[#E2EDED] min-h-screen flex">

    @include('layout.sidebar')

    <main class="flex-1 p-8 overflow-y-auto">

        <header class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Pengembalian Buku</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola Pengembalian Buku</p>
        </header>

        <!-- SEARCH -->
        <x-filter-bar action="{{ route('pengembalian') }}" :filters="[
            [
                'name' => 'status',
                'label' => 'Status',
                'options' => [
                    'menunggu_kembali' => 'Menunggu',
                    'terlambat' => 'Terlambat',
                ],
            ],
        ]" />

        <!-- TABLE -->
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col min-h-[500px]">

            <div class="px-8 py-5 border-b">
                <h3 class="font-semibold text-slate-700">Daftar Buku Dikembalikan</h3>
            </div>

            <!-- SCROLL AREA -->
            <div class="flex-1 overflow-x-auto">
                <div class="min-w-[1200px]">

                    <!-- HEADER -->
                    <div
                        class="sticky top-0 z-10 grid 
                        grid-cols-[80px_200px_160px_120px_120px_120px_120px_120px_120px]
                        bg-[#004d4d] py-4 px-8 text-white font-bold text-center text-sm">

                        <div>Cover</div>
                        <div>Judul</div>
                        <div>Peminjam</div>
                        <div>Pinjam</div>
                        <div>Jatuh Tempo</div>
                        <div>Kembali</div>
                        <div>Denda</div>
                        <div>Status</div>
                        <div>Aksi</div>
                    </div>

                    <!-- DATA -->
                    <div class="flex flex-col w-full">

                        @if ($data->count())
                            @foreach ($data as $item)
                                <div
                                    class="grid 
                                    grid-cols-[80px_200px_160px_120px_120px_120px_120px_120px_120px]
                                    items-center px-8 py-4 border-b text-sm w-full
                                    hover:bg-gray-50 transition
                                    @if (now()->gt($item->tanggal_jatuh_tempo) && !$item->tanggal_kembali) bg-red-50 @endif">

                                    <!-- COVER -->
                                    <div class="flex justify-center">
                                        <img src="{{ asset('storage/' . $item->buku->cover_image) }}"
                                            class="w-12 h-16 object-cover rounded">
                                    </div>

                                    <!-- JUDUL -->
                                    <div class="truncate whitespace-nowrap text-center">
                                        {{ $item->buku->judul_buku }}
                                    </div>

                                    <!-- PEMINJAM -->
                                    <div class="truncate whitespace-nowrap text-center">
                                        {{ $item->user->username ?? '-' }}
                                    </div>

                                    <!-- PINJAM -->
                                    <div class="text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    </div>

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

                                    <!-- KEMBALI -->
                                    <div class="text-center">
                                        {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}
                                    </div>

                                    <!-- DENDA -->
                                    <div class="text-center">
                                        @if ($item->denda > 0)
                                            <span class="text-red-500 font-semibold">
                                                Rp {{ number_format($item->denda) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </div>

                                    <!-- STATUS -->
                                    <div class="text-center">
                                        @if ($item->status == 'menunggu_kembali')
                                            <span class="text-blue-500 font-semibold">Menunggu</span>
                                        @elseif ($item->status == 'terlambat')
                                            <span class="text-red-500 font-semibold">Terlambat</span>
                                        @endif
                                    </div>

                                    <!-- AKSI -->
                                    <div class="text-center space-y-2">

                                        {{-- Kalau ada denda dan belum bayar --}}
                                        @if ($item->denda > 0 && $item->status_denda == 'belum_bayar')
                                            <form action="{{ route('bayar.denda', $item->id) }}" method="POST">
                                                @csrf
                                                <button
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                                                    Konfirmasi Denda
                                                </button>
                                            </form>

                                            {{-- Kalau tidak ada denda / sudah bayar --}}
                                        @elseif (in_array($item->status, ['menunggu_kembali', 'terlambat']))
                                            <form action="{{ route('pengembalian.confirm', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                <button
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded">
                                                    Konfirmasi Pengembalian
                                                </button>
                                            </form>
                                        @endif

                                    </div>

                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center p-20">
                                <p class="text-gray-500">Belum ada pengembalian buku</p>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
            <div class="p-4 bg-white border-t border-gray-50">
                <div>
                    {{ $data->links() }}
                </div>
            </div>

        </section>

    </main>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>
