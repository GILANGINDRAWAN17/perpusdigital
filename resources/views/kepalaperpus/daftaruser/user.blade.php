<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
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
                <h1 class="text-2xl font-bold text-gray-800">User Pustaka</h1>
                <p class="text-gray-500 text-sm mt-1">Berikut daftar seluruh user</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative bg-white p-2 rounded-full shadow-sm cursor-pointer border border-gray-100">
                    <i data-lucide="bell" class="w-6 h-6 text-[#004d4d]"></i>
                    <span
                        class="absolute top-0 right-0 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full border-2 border-white">3</span>
                </div>
            </div>
        </header>

        <div class="flex justify-between items-center mb-10">

            <!-- KIRI -->
            <div class="flex items-center gap-3 flex-1">
                <div class="relative flex-1 max-w-sm shadow-sm">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                    <input type="text" placeholder="Cari User..."
                        class="w-full pl-12 pr-4 py-3.5 rounded-xl border-none focus:ring-2 focus:ring-[#004d4d] outline-none">
                </div>

                <button
                    class="bg-[#004d4d] px-8 py-3.5 rounded-xl text-white font-bold shadow-sm hover:bg-[#003d3d] transition-all duration-300">
                    Cari
                </button>
            </div>

            <!-- KANAN -->
            <a href="{{ route('user.create') }}"
                class="bg-[#004d4d] text-white px-6 py-3.5 rounded-lg font-semibold shadow-sm hover:bg-[#003d3d] transition-all duration-300">
                + Tambah User
            </a>

        </div>

        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col min-h-[300px]">

            <div class="px-8 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-slate-700 text-md">Daftar User Pustaka</h3>
            </div>

            <div class="flex-1 flex flex-col overflow-x-auto">

                <!-- HEADER -->
                <div class="grid grid-cols-[60px_120px_160px_200px_140px_140px_200px_140px] w-max bg-[#004d4d] py-4 px-8 text-white font-bold text-center text-sm">
                    <div>Profile</div>
                    <div>Username</div>
                    <div>Nama Lengkap</div>
                    <div>Email</div>
                    <div>No Telp</div>
                    <div>NIK/NIS</div>
                    <div>Role</div>
                    <div>Aksi</div>
                </div>

                <!-- DATA -->
                @foreach ($users as $user)
                    <div class="grid grid-cols-[60px_120px_160px_200px_140px_140px_200px_140px] w-max items-center py-4 px-8 border-b text-center text-sm hover:bg-gray-50">

                        <div>👤</div>
                        <div>{{ $user->username }}</div>
                        <div>{{ $user->nama_lengkap ?? '-' }}</div>
                        <div>{{ $user->email }}</div>
                        <div>{{ $user->no_telp ?? '-' }}</div>
                        <div>{{ $user->nik_nis ?? '-' }}</div>
                        <div class="capitalize"> {{ str_replace('_', ' ', $user->role) }}</div>

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('user.edit', $user->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="handleDelete(this, '{{ $user->username }}')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 font-medium rounded transition-all duration-300">
                                    Hapus
                                </button>
                            </form>

                        </div>

                    </div>
                @endforeach

            </div>

            <div class="h-8 bg-white border-t border-gray-50"></div>
        </section>

    </main>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();

        function handleDelete(btn, username) {
            const form = btn.closest("form");

            openModal(
                "Hapus User",
                `Yakin ingin menghapus user "<b>${username}</b>"?`,
                function() {
                    form.submit();
                }
            );
        }
    </script>
</body>

</html>
