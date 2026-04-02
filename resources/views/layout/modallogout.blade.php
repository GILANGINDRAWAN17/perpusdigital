<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 h-screen flex items-center justify-center">

  <div class="fixed inset-0 bg-black/40 backdrop-blur-[2px] flex items-center justify-center z-50">
    
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm p-10 flex flex-col items-center">
      
      <h2 class="text-[#1a3a3a] text-2xl font-bold mb-4">Konfirmasi</h2>
      
      <p class="text-[#3a5a5a] text-lg text-center leading-relaxed mb-8">
        Apakah anda yakin<br>ingin keluar?
      </p>

      <div class="flex gap-4 w-full">
        <button class="flex-1 bg-[#ee5e5e] hover:bg-[#e04f4f] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-red-200 transition-all active:scale-95">
          Tidak
        </button>
        
        <button class="flex-1 bg-[#00e6cc] hover:bg-[#00c9b3] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-[#00e6cc]/30 transition-all active:scale-95">
          Ya
        </button>
      </div>

    </div>
  </div>

</body>
</html>