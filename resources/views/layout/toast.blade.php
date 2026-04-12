<div id="toastContainer" class="fixed top-6 right-6 z-[9999] space-y-3"></div>

<script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');

        const toast = document.createElement('div');

        let bg = 'bg-green-100 text-green-700';
        let icon = 'check-circle';

        if (type === 'error') {
            bg = 'bg-red-100 text-red-700';
            icon = 'x-circle';
        }

        if (type === 'warning') {
            bg = 'bg-yellow-100 text-yellow-700';
            icon = 'alert-circle';
        }

        toast.className = `
            px-6 py-4 rounded-xl shadow-lg font-semibold
            transition-all duration-500 transform opacity-0 translate-y-[-10px]
            ${bg}
        `;

        // ✅ PINDAH KE SINI (DALAM FUNCTION)
        toast.innerHTML = `
            <div class="flex items-center gap-2">
                <i data-lucide="${icon}" class="w-5 h-5"></i>
                <span>${message}</span>
            </div>
        `;

        container.appendChild(toast);

        lucide.createIcons();

        // animasi masuk
        setTimeout(() => {
            toast.classList.remove('opacity-0', 'translate-y-[-10px]');
        }, 100);

        // auto hilang
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-20px)';
        }, 3000);

        setTimeout(() => {
            toast.remove();
        }, 3500);
    }
</script>

@if (session('success'))
    <script>
        showToast("{{ session('success') }}", "success");
    </script>
@endif

@if (session('error'))
    <script>
        showToast("{{ session('error') }}", "error");
    </script>
@endif

@if ($errors->any())
    <script>
        showToast("{{ $errors->first() }}", "error");
    </script>
@endif