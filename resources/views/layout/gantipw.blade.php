<script>
        
        function openEditProfileModal() {

            const formHtml = `
        <form id="formEditProfile" method="POST" action="{{ route('profile.update') }}" class="w-full text-left">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="text-sm text-slate-600">Nama Lengkap</label>
                <input type="text" name="nama_lengkap"
                    value="{{ Auth::user()->nama_lengkap }}"
                    class="w-full border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-[#004d4d] outline-none">
            </div>

            <div class="mb-3">
                <label class="text-sm text-slate-600">NIK/NIS</label>
                <input type="text" name="nik_nis"
                    value="{{ Auth::user()->nik_nis }}"
                    class="w-full border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-[#004d4d] outline-none">
            </div>

            <div class="mb-3">
                <label class="text-sm text-slate-600">No Telepon</label>
                <input type="text" name="no_telp"
                    value="{{ Auth::user()->no_telp }}"
                    class="w-full border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-[#004d4d] outline-none">
            </div>
        </form>
    `;

            openModal(
                "Edit Informasi Profil",
                formHtml,
                () => {
                    document.getElementById('formEditProfile').submit();
                }
            );
        }



        function openChangePasswordModal() {

            const formHtml = `
        <form id="formChangePassword" class="w-full text-left space-y-3">

            <div>
                <label class="text-sm text-slate-600">Password Lama</label>
                <div class="relative">
                    <input type="password" id="current_password" name="current_password"
                        class="w-full border border-gray-300 p-2 rounded mt-1 pr-10 focus:ring-2 focus:ring-[#004d4d] outline-none">
                    <span onclick="togglePassword('current_password', this)"
                        class="absolute right-3 top-3 cursor-pointer text-gray-400">
                       <!-- EYE -->
                         <svg class="w-5 h-5 eye-open mt-1" fill="none" stroke="gray" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                            <circle cx="12" cy="12" r="3"/>
                         </svg>

                        <!-- EYE OFF -->
                        <svg class="w-5 h-5 eye-close hidden mt-1" fill="none" stroke="gray" stroke-width="2" viewBox="0 0 24 24">
                           <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a21.77 21.77 0 0 1 5.06-5.94"/>
                           <path d="M1 1l22 22"/>
                           <path d="M9.9 4.24A10.94 10.94 0 0 1 12 5c7 0 11 7 11 7a21.77 21.77 0 0 1-3.06 4.06"/>
                        </svg>
                   </span>
                </div>
                <p class="text-red-500 text-xs mt-1 hidden" id="err_current"></p>
            </div>

            <div>
                <label class="text-sm text-slate-600">Password Baru</label>
                <div class="relative">
                    <input type="password" id="new_password" name="new_password"
                        class="w-full border border-gray-300 p-2 rounded mt-1 pr-10 focus:ring-2 focus:ring-[#004d4d] outline-none">
                    <span onclick="togglePassword('new_password', this)"
                        class="absolute right-3 top-3 cursor-pointer text-gray-400">
                       <!-- EYE -->
                         <svg class="w-5 h-5 eye-open mt-1" fill="none" stroke="gray" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                            <circle cx="12" cy="12" r="3"/>
                         </svg>

                        <!-- EYE OFF -->
                        <svg class="w-5 h-5 eye-close hidden mt-1" fill="none" stroke="gray" stroke-width="2" viewBox="0 0 24 24">
                           <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a21.77 21.77 0 0 1 5.06-5.94"/>
                           <path d="M1 1l22 22"/>
                           <path d="M9.9 4.24A10.94 10.94 0 0 1 12 5c7 0 11 7 11 7a21.77 21.77 0 0 1-3.06 4.06"/>
                        </svg>
                    </svg>
                  </span>
                </div>
                <p class="text-red-500 text-xs mt-1 hidden" id="err_new"></p>
            </div>

            <div>
                <label class="text-sm text-slate-600">Konfirmasi Password</label>
                <div class="relative">
                    <input type="password" id="confirm_password" name="new_password_confirmation"
                        class="w-full border border-gray-300 p-2 rounded mt-1 pr-10 focus:ring-2 focus:ring-[#004d4d] outline-none">
                    <span onclick="togglePassword('confirm_password', this)"
                        class="absolute right-3 top-3 cursor-pointer text-gray-400">

                        <!-- EYE -->
                         <svg class="w-5 h-5 eye-open mt-1" fill="none" stroke="gray" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                            <circle cx="12" cy="12" r="3"/>
                         </svg>

                        <!-- EYE OFF -->
                        <svg class="w-5 h-5 eye-close hidden mt-1" fill="none" stroke="gray" stroke-width="2" viewBox="0 0 24 24">
                           <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a21.77 21.77 0 0 1 5.06-5.94"/>
                           <path d="M1 1l22 22"/>
                           <path d="M9.9 4.24A10.94 10.94 0 0 1 12 5c7 0 11 7 11 7a21.77 21.77 0 0 1-3.06 4.06"/>
                        </svg>
                    </span>
                </div>
                <p class="text-red-500 text-xs mt-1 hidden" id="err_confirm"></p>
            </div>
        </form>
    `;

            openModal("Ganti Password", formHtml, submitChangePassword);

            // ubah tombol
            document.getElementById('confirmBtn').innerText = 'Simpan';
        }

        function togglePassword(id, el) {
            const input = document.getElementById(id);

            const eyeOpen = el.querySelector('.eye-open');
            const eyeClose = el.querySelector('.eye-close');

            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.add('hidden');
                eyeClose.classList.remove('hidden');
            } else {
                input.type = "password";
                eyeOpen.classList.remove('hidden');
                eyeClose.classList.add('hidden');
            }
        }

        function submitChangePassword() {

            // reset error
            document.querySelectorAll('[id^="err_"]').forEach(e => {
                e.classList.add('hidden');
                e.innerText = '';
            });

            const data = {
                current_password: document.getElementById('current_password').value,
                new_password: document.getElementById('new_password').value,
                new_password_confirmation: document.getElementById('confirm_password').value,
                _token: '{{ csrf_token() }}'
            };

            fetch("{{ route('password.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(res => {

                    // kalau error validasi
                    if (res.errors) {
                        if (res.errors.current_password) {
                            showError('err_current', res.errors.current_password[0]);
                        }
                        if (res.errors.new_password) {
                            showError('err_new', res.errors.new_password[0]);
                        }
                        if (res.errors.new_password_confirmation) {
                            showError('err_confirm', res.errors.new_password_confirmation[0]);
                        }
                        return;
                    }

                    // kalau password salah
                    if (res.error) {
                        showError('err_current', res.error);
                        return;
                    }

                    // SUCCESS 🔥
                    closeModal();

                    showToast("Password berhasil diubah", "success");

                });
        }

        function showError(id, msg) {
            const el = document.getElementById(id);
            el.innerText = msg;
            el.classList.remove('hidden');
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');

            toast.className = `
        fixed top-5 right-5 z-[9999]
        px-5 py-3 rounded-lg text-white shadow-lg
        ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}
        animate-[fadeIn_.3s]
    `;

            toast.innerText = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>