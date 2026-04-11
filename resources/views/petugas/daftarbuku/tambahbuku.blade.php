<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    @vite('resources/css/app.css')
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

@include('layout.loading')

<div class="container mx-auto px-6 py-10">

    <div class="bg-white p-6 rounded-xl shadow-md">

        <h2 class="text-xl font-bold mb-6">Tambah Buku</h2>

        <form action="{{ route('buku.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <!-- Kode Buku -->
                <div>
                    <label class="block text-sm mb-1">Kode Buku</label>
                    <input type="text" name="kode_buku"
                           class="w-full border p-2 rounded"
                           placeholder="Masukkan kode buku">
                </div>

                <!-- Judul -->
                <div>
                    <label class="block text-sm mb-1">Judul Buku</label>
                    <input type="text" name="judul_buku"
                           class="w-full border p-2 rounded"
                           placeholder="Masukkan judul">
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block text-sm mb-1">Penulis</label>
                    <input type="text" name="penulis"
                           class="w-full border p-2 rounded"
                           placeholder="Nama penulis">
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm mb-1">Tahun Terbit</label>
                    <input type="date" name="tahun_terbit"
                           class="w-full border p-2 rounded">
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm mb-1">Stock Buku</label>
                    <input type="number" name="stock_buku"
                           class="w-full border p-2 rounded"
                           placeholder="Jumlah stock">
                </div>

                <!-- Cover -->
                <div>
                    <label class="block text-sm mb-1">Cover Buku</label>
                    <input type="file" name="cover_image"
                           class="w-full border p-2 rounded">
                </div>

            </div>

            <!-- Sinopsis -->
            <div class="mt-4">
                <label class="block text-sm mb-1">Sinopsis</label>
                <textarea name="sinopsis"
                          rows="4"
                          class="w-full border p-2 rounded"
                          placeholder="Isi sinopsis buku"></textarea>
            </div>

            <!-- Button -->
            <div class="mt-6 flex justify-center gap-2">
                <button type="submit"
                        class="bg-[#004d4d] hover:bg-[#003d3d] text-white font-semibold transition-all duration-300 px-4 py-2 rounded shadow-md">
                    Simpan
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