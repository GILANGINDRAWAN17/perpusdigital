<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#E2EDED] min-h-screen flex">

    @include('layout.sidebar')

    <main class="flex-1 p-8 overflow-y-auto">
        
        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><span class="font-light">Selamat Datang,</span> {{ Auth::user()->username ?? 'N/A' }}!</h1>
                <p class="text-gray-500 text-sm mt-1">Berikut ringkasan aktivitas perpustakaan</p>
            </div>

        </header>

        

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <!-- Card -->
            <div class="flex items-center gap-5 p-7 bg-white rounded-2xl shadow-sm border border-gray-100 hover:scale-[1.01] hover:shadow-lg transition-all duration-500">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-[#004d4d]/10 text-[#004d4d]">
                    <i data-lucide="file-plus" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-base text-[#003d3d]">Jumlah Pengajuan Saat Ini</p>
                    <p class="text-3xl font-bold text-[#004d4d]">0</p>
                </div>
            </div>

            <div class="flex items-center gap-5 p-7 bg-white rounded-2xl shadow-sm border border-gray-100 hover:scale-[1.01] hover:shadow-lg transition-all duration-500">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-[#004d4d]/10 text-[#004d4d]">
                    <i data-lucide="BookUp" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-base text-[#003d3d]">Jumlah Pinjaman Saat Ini</p>
                    <p class="text-3xl font-bold text-[#004d4d]">0</p>
                </div>
            </div>

            <div class="flex items-center gap-5 p-7 bg-white rounded-2xl shadow-sm border border-gray-100 hover:scale-[1.01] hover:shadow-lg transition-all duration-500">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-[#004d4d]/10 text-[#004d4d]">
                    <i data-lucide="book-check" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-base text-[#003d3d]">Jumlah Buku Yang Dikembalikan</p>
                    <p class="text-3xl font-bold text-[#004d4d]">0</p>
                </div>
            </div>

            <div class="flex items-center gap-5 p-7 bg-white rounded-2xl shadow-sm border border-gray-100 hover:scale-[1.01] hover:shadow-lg transition-all duration-500">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-[#004d4d]/10 text-[#004d4d]">
                    <i data-lucide="book-copy" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-base text-[#003d3d]">Total Buku</p>
                    <p class="text-3xl font-bold text-[#004d4d]">0</p>
                </div>
            </div>

        </div>

        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[400px]">

            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Pengajuan Terbaru</h3>
            </div>

            <div class="flex-1 flex flex-col">
                <div class="grid grid-cols-4 bg-[#004d4d] py-4 px-8 text-white font-bold text-center text-sm">
                    <div>Jumlah Buku</div>
                    <div>Nama Anggota</div>
                    <div>Tanggal Pinjam</div>
                    <div>Keterangan Pengajuan</div>
                </div>
            </div>

            <div class="h-8 bg-white border-t border-gray-50"></div>
        </section>

    </main>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>