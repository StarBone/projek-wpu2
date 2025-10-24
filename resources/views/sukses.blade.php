<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesanan Berhasil</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Penguin UI (komponen Tailwind siap pakai) -->
  <script src="https://unpkg.com/@penguin-ui/core@latest"></script>

  <!-- QRCodeJS -->
  <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-sky-100 via-indigo-100 to-purple-100">

  <div class="bg-white shadow-2xl rounded-2xl p-8 w-[90%] max-w-md text-center penguin-card penguin-fade-in">

    <!-- Animasi sukses -->
    <div class="flex justify-center mb-4">
      <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center animate-bounce">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="green" class="w-10 h-10">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
      </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-2">Pesanan Berhasil!</h2>
    <p class="text-gray-500 mb-6">Terima kasih telah memesan 🎉</p>

    <div class="text-left space-y-3 bg-gray-50 rounded-xl p-4">
      <p><span class="font-semibold text-gray-700">Nomor Order:</span>
         <span class="text-indigo-600">{{ $pesanan->nomor_order }}</span>
      </p>
      <p><span class="font-semibold text-gray-700">Nama Pelanggan:</span>
         {{ $pesanan->pelanggan->nama_pelanggan }}
      </p>
      <p><span class="font-semibold text-gray-700">Total Harga:</span>
         <span class="text-green-600 font-semibold">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
      </p>
    </div>

    <!-- QR Code -->
    <div class="mt-6 flex justify-center">
      <div id="qrcode" class="p-3 bg-white rounded-xl border border-gray-200 shadow-sm"></div>
    </div>

    <!-- Tombol -->
    <div class="mt-8">
      <a href="{{ url('/pesan/' . ($pesanan->tempatDuduk->nomor_tempat ?? 1)) }}"
         class="penguin-btn penguin-btn-primary px-6 py-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition-all duration-200">
         Kembali ke Menu
      </a>
    </div>
  </div>

  <script>
    // Buat QR Code otomatis
    const qrData = "{{ url('/pesan/sukses/' . $pesanan->nomor_order) }}";
    new QRCode(document.getElementById("qrcode"), {
        text: qrData,
        width: 150,
        height: 150,
        colorDark: "#111827",
        colorLight: "#ffffff"
    });
  </script>

</body>
</html>
