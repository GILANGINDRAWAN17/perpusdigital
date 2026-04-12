<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    @vite('resources/css/app.css')
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

@include('layout.loading')

<div class="container mx-auto px-6 py-10">

     <div class="bg-white max-w-3xl mx-auto p-6 rounded-xl shadow-md">

        <h2 class="text-xl font-bold mb-6 text-gray-800">Edit Buku</h2>

        <form action="{{ route('buku.update', $buku->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">

                <!-- Kode Buku -->
                <div>
                    <label class="block text-sm mb-1">Kode Buku</label>
                    <input type="text" name="kode_buku"
                           value="{{ old('kode_buku', $buku->kode_buku) }}"
                           class="w-full border p-2 rounded">
                    @error('kode_buku')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul -->
                <div>
                    <label class="block text-sm mb-1">Judul Buku</label>
                    <input type="text" name="judul_buku"
                           value="{{ old('judul_buku', $buku->judul_buku) }}"
                           class="w-full border p-2 rounded">
                    @error('judul_buku')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block text-sm mb-1">Penulis</label>
                    <input type="text" name="penulis"
                           value="{{ old('penulis', $buku->penulis) }}"
                           class="w-full border rounded p-2">
                    @error('penulis')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm mb-1">Tahun Terbit</label>
                    <input type="date" name="tahun_terbit"
                           value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                           class="w-full border rounded p-2">
                    @error('tahun_terbit')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm mb-1">Stock Buku</label>
                    <input type="number" name="stock_buku"
                           value="{{ old('stock_buku', $buku->stock_buku) }}"
                           class="w-full border rounded p-2">
                    @error('stock_buku')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover -->
                <div>
                    <label class="block text-sm mb-1">Cover Buku</label>
                    <input type="file" name="cover_image"
                           class="w-full border rounded p-2 bg-white">

                    @if($buku->cover_image)
                        <img src="{{ asset('storage/'.$buku->cover_image) }}" class="mt-4">
                    @endif

                    @error('cover_image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Sinopsis -->
            <div class="mt-5">
                <label class="block text-sm mb-1">Sinopsis</label>
                <textarea name="sinopsis"
                          rows="4"
                          class="w-full border rounded p-2">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
                @error('sinopsis')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button -->
            <div class="mt-6 flex justify-center gap-3">
                <button type="submit"
                        class="bg-[#004d4d] hover:bg-[#003d3d] text-white font-semibold transition-all duration-300 px-4 py-2 rounded shadow-md">
                    Update
                </button>

                <a href="{{ route('buku.index') }}"
                  class="bg-gray-500 hover:bg-gray-600 text-white font-semibold transition-all duration-300 px-4 py-2 rounded shadow-md">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@include('layout.toast')

</body>
</html>