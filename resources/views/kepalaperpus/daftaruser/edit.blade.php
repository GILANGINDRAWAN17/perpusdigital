<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    @vite('resources/css/app.css')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

@include('layout.loading')

<div class="container mx-auto px-6 py-10">

    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit User</h2>

        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username"
                        value="{{ old('username', $user->username) }}"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-[#004d4d] outline-none">
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-[#004d4d] outline-none">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap"
                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-[#004d4d] outline-none">
                    @error('nama_lengkap')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No Telp -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No Telp</label>
                    <input type="text" name="no_telp"
                        value="{{ old('no_telp', $user->no_telp) }}"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-[#004d4d] outline-none">
                    @error('no_telp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIK/NIS -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK/NIS</label>
                    <input type="text" name="nik_nis"
                        value="{{ old('nik_nis', $user->nik_nis) }}"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-[#004d4d] outline-none">
                    @error('nik_nis')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-[#004d4d] outline-none">
                        <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
                        <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="kepala_perpustakaan"
                            {{ $user->role == 'kepala_perpustakaan' ? 'selected' : '' }}>
                            Kepala Perpustakaan
                        </option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Button -->
            <div class="mt-6 flex gap-3 justify-center">
                <button type="submit"
                    class="bg-[#004d4d] hover:bg-[#003d3d] text-white px-5 py-2 rounded font-semibold transition-all duration-300">
                    Update
                </button>

                <a href="/daftaruser"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded font-semibold transition-all duration-300">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@include('layout.toast')

</body>
</html>