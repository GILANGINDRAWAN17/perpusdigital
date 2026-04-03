<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#E2EDED] min-h-screen flex">

    @include('layout.sidebarpetugas')

    <main class="flex-1 p-8 overflow-y-auto">
        
        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Username!</h1>
                <p class="text-gray-500 text-sm mt-1">Berikut ringkasan aktivitas perpustakaan</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative bg-white p-2 rounded-full shadow-sm cursor-pointer border border-gray-100">
                    <i data-lucide="bell" class="w-6 h-6 text-[#004d4d]"></i>
                    <span class="absolute top-0 right-0 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full border-2 border-white">3</span>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-[#004d4d]"><i data-lucide="book-copy" class="w-10 h-10"></i></div>
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Total Buku</p>
                    <span class="text-3xl font-bold text-[#004d4d]">0</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-[#004d4d]"><i data-lucide="book-open-check" class="w-10 h-10"></i></div>
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Dipinjam</p>
                    <span class="text-3xl font-bold text-[#004d4d]">0</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-[#004d4d]"><i data-lucide="circle-dollar-sign" class="w-10 h-10"></i></div>
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Denda</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-sm font-bold text-[#004d4d]">Rp</span>
                        <span class="text-3xl font-bold text-[#004d4d]">0</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-[#004d4d]"><i data-lucide="users" class="w-10 h-10"></i></div>
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Anggota</p>
                    <span class="text-3xl font-bold text-[#004d4d]">0</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>