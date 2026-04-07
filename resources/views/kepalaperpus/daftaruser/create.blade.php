<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto px-6 py-10">

        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-8">

            <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah User</h2>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Username -->
                    <div>
                        <label>Username</label>
                        <input type="text" name="username" class="w-full border p-2 rounded">
                    </div>

                    <!-- Email -->
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" class="w-full border p-2 rounded">
                    </div>

                    <!-- Password -->
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" class="w-full border p-2 rounded">
                    </div>

                    <!-- Role -->
                    <div>
                        <label>Role</label>
                        <select name="role" class="w-full border p-2 rounded">
                            <option value="anggota">Anggota</option>
                            <option value="petugas">Petugas</option>
                            <option value="kepala_perpustakaan">Kepala Perpustakaan</option>
                        </select>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="w-full border p-2 rounded">
                    </div>

                    <!-- No Telp -->
                    <div>
                        <label>No Telp</label>
                        <input type="text" name="no_telp" class="w-full border p-2 rounded">
                    </div>

                    <!-- NIK/NIS -->
                    <div>
                        <label>NIK/NIS</label>
                        <input type="text" name="nik_nis" class="w-full border p-2 rounded">
                    </div>

                </div>

                <div class="mt-6 flex justify-center gap-3">
                    <button type="submit"
                        class="bg-[#004d4d] hover:bg-[#003d3d] text-white px-5 py-2 font-semibold rounded-lg transition-all duration-300 shadow-md">
                        Simpan
                    </button>

                    <a href="/daftaruser"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-semibold transition-all duration-300 px-5 py-2 rounded-lg shadow-md">
                        Kembali
                    </a>
                </div>

            </form>

        </div>

    </div>

</body>

</html>
