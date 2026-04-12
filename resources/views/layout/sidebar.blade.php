@if (auth()->check())

    @php
        $user = auth()->user();
        $role = $user->role ?? null;
    @endphp

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <aside class="w-64 bg-[#004d4d] text-white flex flex-col sticky top-0 h-screen shrink-0">

        {{-- LOGO --}}
        <div class="p-8 flex items-center mx-auto gap-3">
            <i data-lucide="book-open" class="w-8 h-8"></i>
            <span class="text-2xl font-bold tracking-tight">Pustaka</span>
        </div>

        {{-- PROFILE --}}
        <div
            class="bg-[#003d3d] scale-90 border border-[#027676] px-4 py-3 flex rounded-lg items-center gap-3 shadow-2xl">

            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center overflow-hidden">

                <img src="{{ $user && $user->foto ? asset('storage/' . $user->foto) : '' }}"
                    class="w-10 h-10 object-cover {{ $user && $user->foto ? '' : 'hidden' }}">

                <div
                    class="w-10 h-10 bg-[#004d4d] flex items-center justify-center text-white
                    {{ $user && $user->foto ? 'hidden' : '' }}">
                    <i data-lucide="user-round" class="w-5 h-5 opacity-80"></i>
                </div>

            </div>

            <div class="ml-1 min-w-0">
                <p class="font-semibold text-md capitalize truncate">
                    {{ $user->username ?? 'N/A' }}
                </p>
                <p class="font-light text-sm capitalize">
                    {{ ucwords(str_replace('_', ' ', $role ?? 'N/A')) }}
                </p>
            </div>

        </div>

        {{-- MENU --}}
        <nav class="flex-1 space-y-2 mt-8">

            {{-- DASHBOARD --}}
            <a href="{{ $role == 'anggota' ? '/dashboard' : ($role == 'petugas' ? '/dashboardpetugas' : '/dashboardkepalaperpus') }}"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                {{ request()->is('dashboard*') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>

            {{-- ANGGOTA --}}
            @if ($role == 'anggota')
                <a href="/katalog"
                    class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                    {{ request()->is('katalog') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                    <i data-lucide="book" class="w-5 h-5"></i>
                    <span>Buku</span>
                </a>

                <a href="/riwayat"
                    class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                    {{ request()->is('riwayat') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                    <i data-lucide="history" class="w-5 h-5"></i>
                    <span>Riwayat</span>
                </a>
            @endif

            {{-- PETUGAS --}}
            @if ($role == 'petugas')
                <a href="/peminjaman"
                    class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                    {{ request()->is('peminjaman') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                    <i data-lucide="book-up" class="w-5 h-5"></i>
                    <span>Peminjaman</span>
                </a>

                <a href="/pengembalian"
                    class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                    {{ request()->is('pengembalian') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                    <i data-lucide="book-down" class="w-5 h-5"></i>
                    <span>Pengembalian</span>
                </a>
            @endif

            {{-- SHARED --}}
            @if (in_array($role, ['petugas', 'kepala_perpustakaan']))
                <a href="{{ route('buku.index') }}"
                    class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                    {{ request()->routeIs('buku.*') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                    <i data-lucide="book-copy" class="w-5 h-5"></i>
                    <span>Daftar Buku</span>
                </a>
            @endif

            {{-- KEPALA --}}
            @if ($role == 'kepala_perpustakaan')
                <a href="/transaksi"
                    class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                    {{ request()->is('transaksi') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                    <i data-lucide="receipt-text" class="w-5 h-5"></i>
                    <span>Transaksi</span>
                </a>

                <a href="/daftaruser"
                    class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                    {{ request()->is('daftaruser') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span>Daftar User</span>
                </a>
            @endif

        </nav>

        {{-- BOTTOM --}}
        <div class="mb-6">

            <a href="{{ $role == 'anggota' ? '/profile' : ($role == 'petugas' ? '/profilepetugas' : '/profilekepala') }}"
                class="flex items-center gap-3 px-6 py-3 transition-all duration-300 text-teal-100
                {{ request()->is('profile*') ? 'bg-[#003d3d] text-white shadow-lg' : 'hover:bg-[#003d3d] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:pl-5' }}">
                <i data-lucide="user" class="w-5 h-5"></i>
                <span>Profil</span>
            </a>

            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>

            <a href="#" onclick="handleLogout()"
                class="px-6 py-3 flex items-center gap-3 text-teal-100 hover:text-white transition-all duration-300">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>Logout</span>
            </a>

        </div>

    </aside>

    <script src="https://unpkg.com/lucide@latest"></script>
    @include('layout.globalmodal')

    <script>
        lucide.createIcons();

        function handleLogout() {
            openModal(
                "Konfirmasi Logout",
                "Apakah anda yakin ingin keluar?",
                function() {
                    document.getElementById('logoutForm').submit();
                }
            );
        }
    </script>

@endif
