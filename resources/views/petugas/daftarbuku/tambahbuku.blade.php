<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-6 py-10">

    <div class="bg-white p-6 rounded-xl shadow-md">

        <h2 class="text-xl font-bold mb-6">➕ Tambah Buku</h2>

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
            <div class="mt-6 flex gap-2">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>

                <a href="{{ route('buku.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>