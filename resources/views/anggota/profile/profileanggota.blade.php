<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <style>
        /* Hilangkan icon bawaan Edge / Chrome */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        input[type="password"]::-webkit-credentials-auto-fill-button,
        input[type="password"]::-webkit-password-toggle-button {
            display: none !important;
            visibility: hidden;
            pointer-events: none;
        }
    </style>
</head>

<body class="bg-[#E2EDED] min-h-screen flex">

    @include('layout.sidebar')

    <main class="flex-1 p-8 overflow-y-auto">

        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Profile</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola Akun Anda</p>
            </div>
            <div class="flex items-center gap-4">
                <div x-data="{ open: false }" class="relative">

                    <!-- ICON -->
                    <div @click="open = !open"
                        class="bg-white p-2 rounded-full shadow-sm cursor-pointer border border-gray-100 relative">

                        <i data-lucide="bell" class="w-6 h-6 text-[#004d4d]"></i>

                        <!-- BADGE -->
                        <span id="notif-badge"
                            class="absolute top-0 right-0 bg-red-500 text-white text-[10px] w-4 h-4 items-center justify-center rounded-full border-2 border-white hidden">
                        </span>
                    </div>

                    <!-- DROPDOWN -->
                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-lg border z-[999] overflow-hidden">

                        <div class="p-4 border-b font-semibold text-[#002d2d]">
                            Notifikasi
                        </div>

                        <div id="notif-list" class="max-h-80 overflow-y-auto"></div>

                        <div class="p-3 text-center text-sm text-[#003d3d] hover:bg-gray-50 cursor-pointer">
                            Lihat semua
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <div class="bg-white rounded-2xl p-8 shadow-xl shadow-slate-200/50 flex items-center gap-8 mb-6">
            <div class="relative group w-32 h-32">

                <!-- FOTO -->
                <img id="previewImage" src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '' }}"
                    class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-inner
                     {{ Auth::user()->foto ? '' : 'hidden' }}">

                <!-- DEFAULT ICON -->
                <div id="defaultIcon"
                    class="w-32 h-32 bg-[#004d4d] rounded-full border-4 border-white shadow-inner flex items-center justify-center text-white
                     {{ Auth::user()->foto ? 'hidden' : '' }}">
                    <i data-lucide="user-round" class="w-20 h-20 opacity-80"></i>
                </div>

                <!-- OVERLAY -->
                <label
                    class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer transition">

                    <span class="text-white text-xs font-semibold">Ubah</span>

                    <input type="file" id="uploadFoto" name="foto" class="hidden" accept="image/*">
                </label>

            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ Auth::user()->username ?? 'N/A' }}</h3>
                <p class="text-slate-500">{{ Auth::user()->email ?? 'N/A' }}</p>
                <div class="flex gap-2 mt-4">
                    <span class="bg-green-500 text-white text-[10px] px-3 py-1 rounded-full font-bold">
                        {{ Auth::user()->status ?? 'Aktif' }}
                    </span>

                    <span class="bg-[#004d4d] text-white text-[10px] px-3 py-1 rounded-full font-bold">
                        {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden mb-6">
            <div class="bg-[#004d4d] px-6 py-3 flex justify-between items-center text-white font-bold">
                Informasi Profil
                <i data-lucide="file-edit" onclick="openEditProfileModal()"
                    class="w-5 h-5 cursor-pointer hover:scale-110 transition"></i>
            </div>
            <div class="p-8 space-y-6">
                <div class="flex">
                    <p class="w-40 text-slate-600 font-medium">Nama Lengkap</p>
                    <p class="mr-4 text-slate-400">:</p>
                    <p class="text-slate-400">
                        {{ Auth::user()->nama_lengkap ?? 'Belum dilengkapi' }}
                    </p>
                </div>
                <div class="flex">
                    <p class="w-40 text-slate-600 font-medium">NIK/NIS</p>
                    <p class="mr-4 text-slate-400">:</p>
                    <p class="text-slate-400">
                        {{ Auth::user()->nik_nis ?? 'Belum dilengkapi' }}
                    </p>
                </div>
                <div class="flex">
                    <p class="w-40 text-slate-600 font-medium">No Telp</p>
                    <p class="mr-4 text-slate-400">:</p>
                    <p class="text-slate-400">
                        {{ Auth::user()->no_telp ?? 'Belum dilengkapi' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-xl shadow-slate-200/50 flex justify-between items-center px-8">
            <div class="flex items-center">
                <p class="w-40 text-slate-600 font-medium">Password</p>
                <p class="mr-4 text-slate-400">:</p>
                <p class="text-slate-400">
                    {{ str_repeat('*', max(6, min(strlen(Auth::user()->password), 10))) }}
                </p>
            </div>
            <button onclick="openChangePasswordModal()"
                class="bg-[#f06262] text-white px-6 py-1.5 rounded-lg text-xs font-bold hover:bg-red-500 transition shadow-md">
                Ganti
            </button>
        </div>
    </main>

    @include('layout.notifikasi')
    @include('layout.gantipw')
    @include('layout.fotoprofile')

    <script>
        lucide.createIcons();
    </script>

    

</body>

</html>
