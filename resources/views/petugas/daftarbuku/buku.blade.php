<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    @vite('resources/css/app.css')

</head>

@include('layout.loading')

<body class="bg-[#E2EDED] min-h-screen flex">

    @include('layout.sidebar')

    <main class="flex-1 p-8 overflow-y-auto">

        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Buku Perpustakaan</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola Buku Perpustakaan</p>
            </div>

        </header>

        <div class="flex justify-between items-start gap-4">

            <!-- KIRI -->
            <div class="flex-1 max-w-xl">
                <x-filter-bar action="{{ route('buku.index') }}" :filters="[
                    [
                        'name' => 'status',
                        'label' => 'Status',
                        'options' => [
                            'tersedia' => 'Tersedia',
                            'habis' => 'Habis',
                        ],
                    ],
                ]" />
            </div>

            <!-- KANAN -->
            @if (Auth::user()->role === 'petugas')
                <a href="{{ route('buku.create') }}"
                    class="bg-[#004d4d] text-white px-6 py-3.5 rounded-xl font-semibold shadow-sm hover:bg-[#003d3d] transition-all duration-300 whitespace-nowrap">
                    + Tambah Buku
                </a>
            @endif

        </div>



        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[400px]">

            <!-- HEADER -->
            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Daftar Buku</h3>
            </div>

            <!-- TABLE -->
            <div class="flex overflow-x-auto">
                <table class="min-w-full text-sm">

                    <!-- THEAD -->
                    <thead class="bg-[#004d4d] py-3 text-white">
                        <tr class="text-center">
                            <th class="p-3">No</th>
                            <th class="p-3">Kode Buku</th>
                            <th class="p-3">Cover</th>
                            <th class="p-3">Judul</th>
                            <th class="p-3">Penulis</th>
                            <th class="p-3">Tahun</th>
                            <th class="p-3">Stock</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>

                    <!-- TBODY -->
                    <tbody>
                        @forelse ($buku as $item)
                            <tr class="border-b hover:bg-gray-100 text-center">
                                <td class="p-3">
                                    {{ ($buku->currentPage() - 1) * $buku->perPage() + $loop->iteration }}</td>

                                <td class="p-3 font-semibold">{{ $item->kode_buku }}</td>
                                <td class="p-3">
                                    @if ($item->cover_image)
                                        <img src="{{ asset('storage/' . $item->cover_image) }}"
                                            class="w-14 h-20 object-cover rounded mx-auto">
                                    @endif
                                </td>

                                <td class="p-3 font-semibold max-w-[200px] truncate">{{ $item->judul_buku }}</td>
                                <td class="p-3 max-w-[150px] truncate">{{ $item->penulis }}</td>
                                <td class="p-3">{{ \Carbon\Carbon::parse($item->tahun_terbit)->format('Y') }}</td>
                                <td class="p-3">{{ $item->stock_buku }}</td>

                                <td class="p-3 text-center space-x-2">

                                    @if (Auth::user()->role === 'petugas')
                                        <!-- EDIT -->
                                        <div class="flex justify-center gap-2 flex-nowrap">
                                            <a href="{{ route('buku.edit', $item->id) }}"
                                                class="bg-yellow-400 text-white whitespace-nowrap px-3 py-1 font-medium rounded border border-yellow-400 hover:bg-yellow-500 transition-all duration-300">
                                                Edit
                                            </a>

                                            <!-- DELETE -->
                                            <form action="{{ route('buku.destroy', $item->id) }}" method="POST"
                                                class="inline" onsubmit="return false">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="handleDelete(this, '{{ $item->judul_buku }}')"
                                                    class="bg-red-500 hover:bg-red-600 whitespace-nowrap text-white px-3 py-1 font-medium rounded transition-all duration-300">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-500 italic">Read Only</span>
                                    @endif

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-5 text-gray-500">
                                    Data kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="p-4 bg-white border-t border-gray-50">
                <div>
                    {{ $buku->links() }}
                </div>
            </div>
        </section>


    </main>

    @include('layout.globalmodal')

    <script>
        lucide.createIcons();

        function handleDelete(btn, title) {
            const form = btn.closest("form");

            openModal(
                "Hapus Buku",
                `Yakin hapus "<b>${title}</b>"?`,
                function() {
                    form.submit();
                }
            );
        }
    </script>



</body>

</html>
