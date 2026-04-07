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

<body class="bg-[#E2EDED] min-h-screen flex">

    @include('layout.sidebar')

    <main class="flex-1 p-8 overflow-y-auto">

        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Profile</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola Akun Anda</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative bg-white p-2 rounded-full shadow-sm cursor-pointer border border-gray-100">
                    <i data-lucide="bell" class="w-6 h-6 text-[#004d4d]"></i>
                    <span
                        class="absolute top-0 right-0 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full border-2 border-white">3</span>
                </div>
            </div>
        </header>

        <div class="bg-white rounded-2xl p-8 shadow-xl shadow-slate-200/50 flex items-center gap-8 mb-6">
            <div
                class="w-32 h-32 bg-[#004d4d] rounded-full border-4 border-white shadow-inner flex items-center justify-center text-white">
                <i data-lucide="user-round" class="w-20 h-20 opacity-80"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ Auth::user()->username ?? 'N/A' }}</h3>
                <p class="text-slate-500">{{ Auth::user()->email ?? 'N/A' }}</p>
                <div class="flex gap-2 mt-4">
                    <span class="bg-[#004d4d] text-white text-[10px] px-3 py-1 rounded-full font-bold">Aktif</span>
                    <span class="bg-[#004d4d] text-white text-[10px] px-3 py-1 rounded-full font-bold">Kepala
                        Perpustakaan</span>
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
                    <p class="text-slate-400 italic">Belum dilengkapi</p>
                </div>
                <div class="flex">
                    <p class="w-40 text-slate-600 font-medium">No Hp</p>
                    <p class="mr-4 text-slate-400">:</p>
                    <p class="text-slate-400 italic">Belum dilengkapi</p>
                </div>
                <div class="flex">
                    <p class="w-40 text-slate-600 font-medium">Jenis Kelamin</p>
                    <p class="mr-4 text-slate-400">:</p>
                    <p class="text-slate-400 italic">Belum dilengkapi</p>
                </div>
                <div class="flex border-none">
                    <p class="w-40 text-slate-600 font-medium">Email</p>
                    <p class="mr-4 text-slate-400">:</p>
                    <p class="text-slate-400 italic">Belum dilengkapi</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-xl shadow-slate-200/50 flex justify-between items-center px-8">
            <div class="flex items-center">
                <p class="w-40 text-slate-600 font-medium">Password</p>
                <p class="mr-4 text-slate-400">:</p>
                <p class="text-slate-400 italic">***********</p>
            </div>
            <button
                class="bg-[#f06262] text-white px-6 py-1.5 rounded-lg text-xs font-bold hover:bg-red-500 transition shadow-md">
                Ganti
            </button>
        </div>
    </main>
    
    <script>
        lucide.createIcons();
    </script>

</body>

</html>
