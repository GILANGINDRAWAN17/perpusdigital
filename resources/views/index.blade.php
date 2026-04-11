<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Pustaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .animated-bg {
            background: linear-gradient(60deg, #002b2b, #045454, #006868, #001f1f);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>


<body class="min-h-screen flex items-center justify-center animated-bg">


    <div id="container"
        class="w-full max-w-6xl h-[630px] bg-[#004d4d] scale-90 flex rounded-2xl shadow-2xl overflow-hidden relative">



        <!-- LEFT SIDE -->
        <div id="leftPanel" class="w-1/2 p-12 text-white transition-all duration-700 ease-in-out scale-100 opacity-100">

            <!-- Logo -->
            <div class="mb-2">
                <i data-lucide="book-open" class="text-white w-10 h-10 mx-auto mb-2"></i>

                <h1 id="title" class="text-3xl text-center font-bold">
                    Selamat Datang
                </h1>

            </div>

            <p id="desc" class="mb-6 text-center text-sm font-light">
                Silahkan login terlebih dahulu
            </p>

            <!-- Form -->
            <form id="authForm" action="/login" method="POST" class="max-w-sm mx-auto">
                @csrf

                <!-- EMAIL (REGISTER ONLY) -->
                <div id="emailField" class="mb-4 hidden">
                    <label class="block text-sm mb-2 font-medium text-white">Email</label>

                    <div
                        class="flex items-center bg-white rounded-full px-4 py-3 text-black gap-4 shadow-lg border border-gray-200 focus-within:ring-2 focus-within:ring-[#00b39e] focus-within:border-[#00b39e] transition-all duration-300">

                        <i data-lucide="mail" class="text-[#004d4d]"></i>

                        <input type="text" name="email" placeholder="Masukkan email anda..."
                            class="w-full outline-none text-md placeholder-gray-400 bg-transparent">
                    </div>
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label class="block text-sm mb-2 font-medium text-white">Username</label>

                    <div
                        class="flex items-center bg-white rounded-full px-4 py-3 text-black gap-4 shadow-lg border border-gray-200 focus-within:ring-2 focus-within:ring-[#00b39e] focus-within:border-[#00b39e] transition-all duration-300">

                        <i data-lucide="user" class="text-[#004d4d]"></i>

                        <input id="usernameInput" name="username" type="text" placeholder="Masukkan username anda..."
                            class="w-full outline-none text-md placeholder-gray-400 bg-transparent">
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label class="block text-sm mb-2 font-medium text-white">Password</label>

                    <div
                        class="flex items-center bg-white rounded-full px-4 py-3 text-black gap-4 shadow-lg border border-gray-200 focus-within:ring-2 focus-within:ring-[#00b39e] focus-within:border-[#00b39e] transition-all duration-300">

                        <i data-lucide="key" class="text-[#004d4d]"></i>

                        <input id="passwordInput" name="password" type="password"
                            placeholder="Masukkan password anda..."
                            class="w-full outline-none text-md placeholder-gray-400 bg-transparent">

                    </div>
                </div>

                <!-- Button -->
                <button id="submitBtn"
                    class="w-full font-medium bg-[#002b2b] hover:bg-[#001f1f] py-3 mt-6 rounded-full border-none shadow-md hover:scale-95 shadow-[#003d3d] hover:shadow-xl transition-all duration-300">
                    Login
                </button>

            </form>

            <p class="text-xs mt-8 text-center opacity-30 font-light text-white">
                © 2026 Gilang Indrawan <br> SMKN 3 BANJAR
            </p>
        </div>

        <!-- RIGHT SIDE -->
        <div id="rightPanel"
            class="w-1/2 p-12 bg-white flex flex-col items-center justify-center transition-all duration-700 ease-in-out">

            <div class="mb-10 text-[#003d3d]">
                <p id="rightTitle" class="text-xl text-center font-bold mb-4">
                    Belum Memiliki Akun?
                </p>
                <p id="rightDesc" class="text-center text-sm font-light">
                    Silahkan Registrasi akun terlebih dahulu
                </p>
            </div>

            <button onclick="togglePanel()" id="switchBtn" type="button"
                class="font-medium bg-[#004d4d] text-white px-12 py-4 hover:bg-[#003d3d] border-none hover:shadow-xl rounded-full shadow-md hover:scale-95 transition-all duration-300">
                Register
            </button>

        </div>

    </div>

    @include('layout.toast')

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        let isRegister = false;

        function togglePanel() {
            const form = document.getElementById("authForm");

            if (!isRegister) {
                form.action = "/register"; // pindah ke register
            } else {
                form.action = "/login"; // balik ke login
            }


            const left = document.getElementById("leftPanel");
            const right = document.getElementById("rightPanel");

            const username = document.getElementById("usernameInput");
            const password = document.getElementById("passwordInput");
            const emailInput = document.querySelector("input[name='email']");

            if (!isRegister) {
                username.placeholder = "Buat username anda...";
                password.placeholder = "Buat password anda...";
                emailInput.setAttribute("required", true);
            } else {
                username.placeholder = "Masukkan username anda...";
                password.placeholder = "Masukkan password anda...";
                emailInput.removeAttribute("required");
            }

            const title = document.getElementById("title");
            const desc = document.getElementById("desc");
            const btn = document.getElementById("submitBtn");
            const email = document.getElementById("emailField");

            const rightTitle = document.getElementById("rightTitle");
            const rightDesc = document.getElementById("rightDesc");

            const switchBtn = document.getElementById("switchBtn");

            if (!isRegister) {
                switchBtn.innerText = "Login";
            } else {
                switchBtn.innerText = "Register";
            }

            // ANIMASI GESER
            left.classList.toggle("translate-x-full");
            right.classList.toggle("-translate-x-full");

            // UBAH FORM
            if (!isRegister) {
                title.innerText = "Buat Akun";
                desc.innerText = "Silahkan isi data untuk registrasi";
                btn.innerText = "Register";

                rightTitle.innerText = "Sudah Memiliki Akun?";
                rightDesc.innerText = "Silahkan Login ke akun anda";

                email.classList.remove("hidden");

            } else {
                title.innerText = "Selamat Datang";
                desc.innerText = "Silahkan login terlebih dahulu";
                btn.innerText = "Login";

                rightTitle.innerText = "Belum Memiliki Akun?";
                rightDesc.innerText = "Silahkan Registrasi akun terlebih dahulu";

                email.classList.add("hidden");

                // BONUS: clear email biar gak nyisa
                emailInput.value = "";
            }

            isRegister = !isRegister;
        }
    </script>

</body>

</html>
