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

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#E2EDED] min-h-screen flex">

    @include('layout.sidebaranggota')

    <main class="flex-1 p-8 overflow-y-auto">

        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Katalog Buku</h1>
                <p class="text-gray-500 text-sm mt-1">Temukan Buku Favorit Anda</p>
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
            <div class="relative flex-1 max-w-sm shadow-sm">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                <input type="text" placeholder="Cari buku..."
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border-none focus:ring-2 focus:ring-[#004d4d] outline-none">
            </div>
            <button class="bg-[#004d4d] p-3.5 rounded-xl text-white shadow-sm hover:brightness-105 transition">
                <i data-lucide="list-filter" class="w-6 h-6"></i>
            </button>
            <button
                class="bg-[#004d4d] px-10 py-3.5 rounded-xl text-white font-bold shadow-sm hover:bg-[#00c9b3] transition">
                Cari
            </button>
        </div>

        <section class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50">
            <h3 class="font-bold text-slate-700 mb-6 text-lg tracking-wide">Kategori</h3>

            <div class="flex gap-3 mb-10">
                <button class="bg-[#004d4d] text-white px-8 py-2 rounded-full text-sm font-semibold">Semua</button>
                <button
                    class="bg-[#f8fafc] border border-slate-100 text-slate-500 px-8 py-2 rounded-full text-sm font-medium hover:border-[#004d4d] hover:text-[#004d4d] transition">Novel</button>
                <button
                    class="bg-[#f8fafc] border border-slate-100 text-slate-500 px-8 py-2 rounded-full text-sm font-medium hover:border-[#004d4d] hover:text-[#004d4d] transition">Komik</button>
                <button
                    class="bg-[#f8fafc] border border-slate-100 text-slate-500 px-8 py-2 rounded-full text-sm font-medium hover:border-[#004d4d] hover:text-[#004d4d] transition">Sains</button>
                <button
                    class="bg-[#f8fafc] border border-slate-100 text-slate-500 px-8 py-2 rounded-full text-sm font-medium hover:border-[#004d4d] hover:text-[#004d4d] transition">Teknologi</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                <div
                    class="bg-white border border-slate-50 p-5 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 flex gap-5 group">
                    <div
                        class="w-32 h-44 bg-slate-200 rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <div class="flex flex-col justify-between flex-1">
                        <div class="space-y-2 text-sm">
                            <p class="text-slate-400 font-medium italic">Judul : <span
                                    class="text-slate-700 not-italic font-semibold ml-1">Judul Buku</span></p>
                            <p class="text-slate-400 font-medium italic">Penulis : <span
                                    class="text-slate-700 not-italic font-semibold ml-1">Nama Penulis</span></p>
                            <p class="text-slate-400 font-medium italic">Tahun : <span
                                    class="text-slate-700 not-italic font-semibold ml-1">2026</span></p>
                            <p class="text-slate-400 font-medium italic">Status : <span
                                    class="text-teal-500 not-italic font-bold ml-1">Tersedia</span></p>
                        </div>
                        <button
                            class="bg-[#004d4d] text-white text-xs font-black uppercase tracking-wider py-2.5 px-6 rounded-lg self-start mt-3 hover:bg-[#00c9b3] shadow-md shadow-[#004d4d]/20 transition-colors">
                            Pinjam
                        </button>
                    </div>
                </div>

                <div
                    class="bg-white border border-slate-50 p-5 rounded-2xl shadow-md hover:shadow-xl transition-all flex gap-5 group">
                    <div
                        class="w-32 h-44 bg-slate-200 rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="flex flex-col justify-between flex-1 text-sm">
                        <div class="space-y-2">
                            <p class="text-slate-400 font-medium italic">Judul : <span
                                    class="text-slate-700 not-italic font-semibold ml-1">Judul Buku</span></p>
                            <p class="text-slate-400 font-medium italic">Penulis : <span
                                    class="text-slate-700 not-italic font-semibold ml-1">Nama Penulis</span></p>
                            <p class="text-slate-400 font-medium italic">Tahun : <span
                                    class="text-slate-700 not-italic font-semibold ml-1">2026</span></p>
                            <p class="text-slate-400 font-medium italic">Status : <span
                                    class="text-teal-500 not-italic font-bold ml-1">Tersedia</span></p>
                        </div>
                        <button
                            class="bg-[#004d4d] text-white text-xs font-black uppercase tracking-wider py-2.5 px-6 rounded-lg self-start mt-3 hover:bg-[#00c9b3] shadow-md shadow-[#004d4d]/20 transition-colors">Pinjam</button>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>

</html>
