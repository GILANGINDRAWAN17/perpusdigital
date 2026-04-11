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
</head>

@include('layout.loading')

<body class="bg-[#E2EDED] min-h-screen flex">

    @include('layout.sidebar')

    <main class="flex-1 p-8 overflow-y-auto">

        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Profile</h1>
                <p class="text-gray-500 text-sm">Kelola Akun Anda</p>
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
                <i data-lucide="file-edit" class="w-5 h-5 cursor-pointer hover:scale-110 transition"></i>
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

    @include('layout.toast')
    @include('layout.gantipw')
    @include('layout.fotoprofile')

    <script>
        lucide.createIcons();
    </script>

</body>

</html>
