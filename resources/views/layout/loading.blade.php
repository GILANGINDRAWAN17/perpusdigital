<!-- LOADING MODAL -->
<div id="pageLoader"
    class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-black/20 z-[9999] opacity-0 pointer-events-none transition-all duration-300">

    <div
        class="bg-white rounded-2xl shadow-lg px-20 py-12 flex flex-col items-center gap-3 scale-95 transition-all duration-300">
        <div class="w-10 h-10 border-4 border-[#004d4d] border-t-transparent rounded-full animate-spin"></div>
        <p class="animate-pulse text-sm text-gray-600 mt-2">Memuat...</p>
    </div>
</div>

<script>
    const loader = document.getElementById("pageLoader");

    // Tampilkan loader saat halaman mulai load
    window.addEventListener("beforeunload", function() {
        loader.classList.remove("opacity-0", "pointer-events-none");
        loader.classList.add("opacity-100");

        loader.querySelector("div").classList.remove("scale-95");
        loader.querySelector("div").classList.add("scale-100");
    });

    // Sembunyikan setelah halaman selesai load
    window.addEventListener("load", function() {
        loader.classList.add("opacity-0");

        setTimeout(() => {
            loader.classList.add("pointer-events-none");
        }, 300);
    });

  
</script>
