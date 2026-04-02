<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-6 py-8">

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">📚 Data Buku</h1>
        <a href="{{ route('buku.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            + Tambah Buku
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-200 text-sm">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Kode Buku</th>
                    <th class="p-3">Cover</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Penulis</th>
                    <th class="p-3">Tahun</th>
                    <th class="p-3">Stock</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($buku as $item)
                <tr class="border-b hover:bg-gray-100">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    
                    <td class="p-3 font-semibold">{{ $item->kode_buku }}</td>
                    <td class="p-3">
                        @if($item->cover_image)
                            <img src="{{ asset('storage/'.$item->cover_image) }}"
                                 class="w-14 h-20 object-cover rounded">
                        @endif
                    </td>

                    <td class="p-3 font-semibold">{{ $item->judul_buku }}</td>
                    <td class="p-3">{{ $item->penulis }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($item->tahun_terbit)->format('Y') }}</td>
                    <td class="p-3">{{ $item->stock_buku }}</td>

                    <td class="p-3 text-center space-x-2">

                        <!-- VIEW -->
                        {{-- <a href="{{ route('buku.show', $item->id) }}" --}}
                        {{-- <a href="#"
                        class="bg-green-500 text-white px-3 py-1 rounded">
                            View
                        </a> --}}

                        <!-- EDIT -->
                        <a href="{{ route('buku.edit', $item->id) }}"
                           class="bg-yellow-400 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('buku.destroy', $item->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Yakin hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Hapus
                            </button>
                        </form>

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

</div>

</body>
</html>