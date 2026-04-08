<!-- MODAL -->
<div id="globalModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">

    <div id="modalBox"
        class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md p-12 flex flex-col items-center scale-90 opacity-0 transition-all duration-300 ease-out">

        <h2 id="modalTitle" class="text-2xl font-bold mb-4 text-[#001d1d]">
            Konfirmasi
        </h2>

        <div id="modalText" class="text-gray-600 text-lg text-center w-full mb-6">
            <!-- isi dinamis -->
        </div>

        <form id="formPinjam" method="POST" class="w-full hidden">
            @csrf

            <div class="mb-3">
                <label class="text-sm">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="w-full border p-2 rounded mt-1" required>
            </div>

            <div class="mb-3">
                <label class="text-sm">Tanggal Jatuh Tempo</label>
                <input type="date" name="tanggal_jatuh_tempo" class="w-full border p-2 rounded mt-1" required>
            </div>
        </form>

        <div class="flex gap-3 w-full">
            <button onclick="closeModal()"
                class="flex-1 bg-gray-500 font-semibold hover:bg-gray-600 px-4 shadow-md text-white py-3 rounded-xl transition-all duration-300">
                Batal
            </button>

            <button id="confirmBtn" type="button"
                class="flex-1 bg-red-500 font-semibold hover:bg-red-600 px-4 shadow-md text-white py-3 rounded-xl transition-all duration-300">
                Ya
            </button>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    let modalAction = null;

    function openModal(title, text, action = null, type = null, id = null) {
        const modal = document.getElementById('globalModal');
        const box = document.getElementById('modalBox');
        const form = document.getElementById('formPinjam');

        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalText').innerHTML = text;

        modalAction = action;

        // 🔥 kalau modal pinjam
        if (type === 'pinjam') {
            form.classList.remove('hidden');

            // set action ke route kamu
            form.action = `/pinjam/${id}`;
        } else {
            form.classList.add('hidden');
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        requestAnimationFrame(() => {
            box.classList.remove('scale-90', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeModal() {
        const modal = document.getElementById('globalModal');
        const box = document.getElementById('modalBox');

        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-90', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById('confirmBtn').addEventListener('click', function() {

            const form = document.getElementById('formPinjam');

            // 🔥 kalau ada form → submit
            if (!form.classList.contains('hidden')) {
                form.submit();
                return;
            }

            // kalau bukan form
            if (modalAction) modalAction();
        });

        document.getElementById('globalModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    });
</script>
