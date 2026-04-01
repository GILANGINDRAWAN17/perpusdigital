<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">✏️ Edit Buku</h2>

        <form action="{{ route('buku.update', $buku->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Kode Buku -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Buku</label>
                    <input type="text" name="kode_buku"
                           value="{{ old('kode_buku', $buku->kode_buku) }}"
                           class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                    @error('kode_buku')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Buku</label>
                    <input type="text" name="judul_buku"
                           value="{{ old('judul_buku', $buku->judul_buku) }}"
                           class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                    @error('judul_buku')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Penulis</label>
                    <input type="text" name="penulis"
                           value="{{ old('penulis', $buku->penulis) }}"
                           class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                    @error('penulis')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                    <input type="date" name="tahun_terbit"
                           value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                           class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                    @error('tahun_terbit')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock Buku</label>
                    <input type="number" name="stock_buku"
                           value="{{ old('stock_buku', $buku->stock_buku) }}"
                           class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                    @error('stock_buku')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Cover Buku</label>
                    <input type="file" name="cover_image"
                           class="mt-1 w-full border rounded-lg p-2 bg-white">

                    @if($buku->cover_image)
                        <img src="{{ asset('storage/'.$buku->cover_image) }}"
                             class="mt-3 w-28 rounded shadow">
                    @endif

                    @error('cover_image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Sinopsis -->
            <div class="mt-5">
                <label class="block text-sm font-medium text-gray-700">Sinopsis</label>
                <textarea name="sinopsis"
                          rows="4"
                          class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
                @error('sinopsis')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button -->
            <div class="mt-6 flex gap-3">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow">
                    Update
                </button>

                <a href="{{ route('buku.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>