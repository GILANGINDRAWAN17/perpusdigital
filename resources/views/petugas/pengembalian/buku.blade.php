<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>
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
                <h1 class="text-2xl font-bold text-gray-800">Pengembalian Buku</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola Pengembalian Buku</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative bg-white p-2 rounded-full shadow-sm cursor-pointer border border-gray-100">
                    <i data-lucide="bell" class="w-6 h-6 text-[#004d4d]"></i>
                    <span
                        class="absolute top-0 right-0 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full border-2 border-white">3</span>
                </div>
            </div>
        </header>


        <div class="flex gap-4 mb-10">
            <div class="relative flex-1 max-w-xs shadow-sm">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                <input type="text" placeholder="Cari pengembalian buku..."
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border-none focus:ring-2 focus:ring-[#004d4d] outline-none shadow-md">
            </div>

            <button
                class="bg-[#004d4d] px-6 py-3.5 rounded-xl text-white font-semibold shadow-sm flex items-center gap-2 hover:brightness-105 transition">
                Status <i data-lucide="chevron-down" class="w-4 h-4"></i>
            </button>

            <button
                class="bg-[#004d4d] px-10 py-3.5 rounded-xl text-white font-bold shadow-sm hover:bg-[#003d3d] transition-all duration-300">
                Cari
            </button>
        </div>

        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[500px]">

            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Daftar Buku Dikembalikan</h3>
            </div>

            <div class="flex-1 flex flex-col">
                <div class="grid grid-cols-6 bg-[#004d4d] py-4 px-8 text-white font-bold text-center text-sm">
                    <div>Cover</div>
                    <div>Judul</div>
                    <div>Pinjam</div>
                    <div>Kembali</div>
                    <div>Status</div>
                    <div>Aksi</div>
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
