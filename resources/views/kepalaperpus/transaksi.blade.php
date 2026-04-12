<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
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
                <h1 class="text-2xl font-bold text-gray-800">Transaksi Buku</h1>
                <p class="text-gray-500 text-sm mt-1">Berikut ringkasan transaksi buku</p>
            </div>

        </header>

        <div class="flex justify-between items-start">

            <!-- KIRI -->
            <div class="flex items-start gap-3 flex-1">
                <x-filter-bar action="{{ route('transaksi') }}" :filters="[
                    [
                        'name' => 'status',
                        'label' => 'Status',
                        'options' => [
                            'pending' => 'Pending',
                            'dipinjam' => 'Dipinjam',
                            'menunggu_kembali' => 'Menunggu',
                            'terlambat' => 'Terlambat',
                            'selesai' => 'Selesai',
                        ],
                    ],
                ]" />
            </div>

            <!-- KANAN -->
            <a href="{{ route('transaksi.export') }}" target="_blank"
                class="bg-[#004d4d] text-white px-6 py-3.5 rounded-lg font-semibold shadow-sm 
                        hover:bg-[#003d3d] transition-all duration-300 inline-flex items-center gap-2">
                <i data-lucide="file-down" class="w-5 h-5"></i>
                <span>Export PDF</span>

            </a>
        </div>

        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[300px]">

            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Daftar Transaksi</h3>
            </div>

            <div class="flex-1 flex flex-col overflow-x-auto">
                <div
                    class="grid grid-cols-[100px_200px_2fr_1.5fr_1.5fr_2.5fr_1fr] w-full items-center py-3 px-6 bg-[#004d4d] font-bold text-sm text-center text-white">
                    <div>Kode</div>
                    <div>Judul Buku</div>
                    <div>Peminjam</div>
                    <div>Pinjam</div>
                    <div>Jatuh Tempo</div>
                    <div>Petugas</div>
                    <div>Status</div>
                </div>

                <div class="flex-1 flex flex-col items-center">

                    @if ($data->count())
                        @foreach ($data as $item)
                            <div
                                class="grid grid-cols-[100px_200px_2fr_1.5fr_1.5fr_2.5fr_1fr] 
                                       w-full items-center py-4 px-6 border-b text-sm text-center">

                                {{-- KODE --}}
                                <div class="truncate flex justify-center">
                                    {{ $item->buku->kode_buku ?? '-' }}
                                </div>

                                {{-- JUDUL BUKU --}}
                                <div class="truncate flex justify-center">
                                    {{ $item->buku->judul_buku ?? '-' }}
                                </div>

                                {{-- PEMINJAM --}}
                                <div class="truncate flex justify-center">
                                    {{ $item->user->nama_lengkap ?? '-' }}
                                </div>

                                {{-- PINJAM --}}
                                <div class="truncate flex justify-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                </div>

                                {{-- JATUH TEMPO --}}
                                <div class="truncate flex justify-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                </div>

                                {{-- PETUGAS --}}
                                <div class="truncate flex justify-center">
                                    @if ($item->petugas)
                                        {{ $item->petugas->nama_lengkap }}
                                    @else
                                        <span class="text-gray-400 italic">Belum dikonfirmasi</span>
                                    @endif
                                </div>



                                {{-- STATUS --}}
                                <div class="truncate flex justify-center">
                                    @if ($item->status == 'pending')
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    @elseif ($item->status == 'dipinjam')
                                        <span class="text-green-500 font-semibold">Dipinjam</span>
                                    @elseif ($item->status == 'menunggu_kembali')
                                        <span class="text-blue-500 font-semibold">Menunggu</span>
                                    @elseif ($item->status == 'terlambat')
                                        <span class="text-red-500 font-semibold">Terlambat</span>
                                    @elseif ($item->status == 'selesai')
                                        <span class="text-gray-500 font-semibold">Selesai</span>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="flex items-center justify-center p-10">
                            <p class="text-gray-500">Belum ada transaksi</p>
                        </div>
                    @endif

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
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>

</html>
