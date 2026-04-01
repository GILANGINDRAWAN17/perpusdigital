<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Pustaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-teal-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-6xl bg-teal-400 scale-90 border flex rounded-2xl shadow-lg overflow-hidden">

        <!-- LEFT SIDE -->
        <div class="w-1/2 p-12 text-white">

            <!-- Logo -->
            <div class="mb-8">
                <div class="text-4xl mb-2 text-center">📖</div>
                <h1 class="text-3xl text-center font-bold">Selamat Datang</h1>
                <p class="text-lg text-center">di Pustaka</p>
            </div>

            <p class="mb-6 text-center text-sm">Silahkan login terlebih dahulu</p>

            <!-- Form -->
            <form>

                <!-- Username -->
                <div class="mb-4">
                    <label class="block text-sm mb-1">Username</label>
                    <div class="flex items-center bg-white rounded-lg px-3 py-2 text-black">
                        <span class="mr-2">👤</span>
                        <input type="text" placeholder="Masukkan username anda" class="w-full outline-none text-sm">
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label class="block text-sm mb-1">Password</label>
                    <div class="flex items-center bg-white rounded-lg px-3 py-2 text-black">
                        <span class="mr-2">🔑</span>
                        <input type="password" placeholder="Masukkan password anda" class="w-full outline-none text-sm">
                    </div>
                </div>

                <div class="text-right mb-4">
                    <a href="#" class="text-xs underline">Lupa Password?</a>
                </div>

                <!-- Button -->
                <button class="w-full bg-teal-900 hover:bg-teal-800 py-2 rounded-lg">
                    Login
                </button>

                <p class="text-xs mt-4 text-center text-black">
                    Belum memiliki akun?
                    <a href="#" class="underline">Register</a>
                </p>

            </form>

            <p class="text-xs mt-8 text-center text-black">
                © 2026 Gilang Indrawan <br> SMKN 3 BANJAR
            </p>
        </div>

        <!-- RIGHT SIDE -->
        <div class="w-1/2 relative bg-white flex items-center justify-center">

            <!-- Image -->
            <img src="{{ asset('images/satoru_gojo_render__by_norm4nsz_dhlt2jw-pre.png') }}" width="320px">

            <p class="absolute bottom-2 right-4 text-xs text-gray-700">
                Illustration by DevianArt
            </p>
        </div>

    </div>

</body>

</html>
