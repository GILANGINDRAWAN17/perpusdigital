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

    <aside class="w-64 bg-[#004d4d] text-white flex flex-col sticky top-0 h-screen shrink-0">
        <div class="p-8 flex items-center mx-auto gap-3">
            <i data-lucide="book-open" class="w-8 h-8"></i>
            <span class="text-2xl font-bold tracking-tight">Pustaka</span>
        </div>

        <div
            class="bg-[#003d3d] scale-90 border border-[#027676] px-4 py-3 flex rounded-lg items-center gap-3 cursor-pointer shadow-2xl">
            <div class="w-10 h-10 bg-white rounded-full shadow-inner flex items-center justify-center text-white">
                <i data-lucide="user-round" class="w-5 h-5 text-[#004d4d]"></i>
            </div>
            <div class="ml-1">
                <p class="font-semibold text-md">Nama User</p>
                <p class="font-light text-sm">Role User</p>
            </div>
        </div>

        <nav class="flex-1 space-y-2 mt-8">
            <a href="dashboardkepalaperpus"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('dashboardkepalaperpus') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>

            <a href="transaksi"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('transaksi') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="ReceiptText" class="w-5 h-5"></i>
                <span>Transaksi</span>
            </a>
            <a href="daftarbukukep"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('daftarbukukep') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="book-copy" class="w-5 h-5"></i>
                <span>Daftar Buku</span>
            </a>
            <a href="daftaruser"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('daftaruser') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>Daftar User</span>
            </a>
        </nav>

        <div class="mb-6">
            <a href="profilekepala"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                 {{ request()->is('profilekepala') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="user" class="w-5 h-5"></i>
                <span>Profil</span>
            </a>
            <a href="#" onclick="toggleModal(true)"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:text-white transition-all duration-300 group">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>Logout</span>
            </a>
        </div>


    </aside>

    <div id="logoutModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">
        <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-10 flex flex-col items-center scale-90 transition-transform duration-300"
            id="modalContent">

            <h2 class="text-[#1a3a3a] text-2xl font-bold mb-4 tracking-tight">Konfirmasi</h2>

            <p class="text-[#3a5a5a] text-lg text-center leading-relaxed mb-8">
                Apakah anda yakin<br>ingin keluar?
            </p>

            <div class="flex gap-4 w-full">
                <button onclick="toggleModal(false)"
                    class="flex-1 bg-[#ee5e5e] hover:bg-[#e04f4f] text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-red-500 duration-300 transition-all active:scale-95">
                    Tidak
                </button>

                <button onclick="confirmLogout()"
                    class="flex-1 bg-[#004d4d] hover:bg-[#003d3d] text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-[#004d4d] duration-300 transition-all active:scale-95">
                    Ya
                </button>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();

        function toggleModal(show) {
            const modal = document.getElementById('logoutModal');
            const content = document.getElementById('modalContent');

            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                // Animasi sedikit membesar (pop-in)
                setTimeout(() => {
                    content.classList.remove('scale-90');
                    content.classList.add('scale-100');
                }, 10);
            } else {
                content.classList.remove('scale-100');
                content.classList.add('scale-90');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }, 200);
            }
        }

        function confirmLogout() {
            // Ganti dengan logika logout kamu (misal: redirect ke login.html)
            alert("Proses Logout...");
            window.location.href = "login.html";
        }

        // Menutup modal jika user klik di area luar kartu (overlay)
        document.getElementById('logoutModal').addEventListener('click', function(e) {
            if (e.target === this) toggleModal(false);
        });
    </script>

</body>

</html>
