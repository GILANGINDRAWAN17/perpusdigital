<!-- MODAL -->
<div id="globalModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">

    <div id="modalBox"
        class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md p-12 flex flex-col items-center scale-90 opacity-0 transition-all duration-300 ease-out">

        <h2 id="modalTitle" class="text-2xl font-bold mb-4 text-[#001d1d]">
            Konfirmasi
        </h2>

        <p id="modalText" class="text-gray-600 text-lg text-center leading-relaxed mb-8">
            Apakah anda yakin?
        </p>

        <div class="flex gap-3 w-full">
            <button onclick="closeModal()"
                class="flex-1 bg-gray-500 font-semibold hover:bg-gray-600 px-4 shadow-md text-white py-3 rounded-xl transition-all duration-300">
                Batal
            </button>

            <button id="confirmBtn"
                class="flex-1 bg-red-500 font-semibold hover:bg-red-600 px-4 shadow-md text-white py-3 rounded-xl transition-all duration-300">
                Ya
            </button>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
let modalAction = null;

function openModal(title, text, action) {
    const modal = document.getElementById('globalModal');
    const box = document.getElementById('modalBox');

    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalText').innerHTML = text;

    modalAction = action;

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

// tombol YA
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('confirmBtn').addEventListener('click', function () {
        if (modalAction) modalAction();
    });

    // klik luar modal
    document.getElementById('globalModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
});
</script>