<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemesanan Berhasil</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Penguin UI -->
  <script src="https://unpkg.com/@penguin-ui/core@latest"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 p-6">

  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-8 text-center penguin-fade-in">
        <div class="flex justify-center mb-4">
      <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center animate-bounce">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="green" class="w-10 h-10">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
      </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-2">Pesanan Berhasil!</h2>
    <p class="text-gray-500 mb-6">Terima kasih sudah memesan. Berikut detail pesanan Anda:</p>

    <!-- Detail Pemesanan -->
    <div class="text-left bg-gray-50 border border-gray-200 rounded-xl p-5 mb-6">
      <p><span class="font-semibold text-gray-800">{{ $pesanan->created_at }}</span></p>
      <p><span class="font-semibold text-gray-800">Nomor Order:</span> {{ $pesanan->nomor_order }}</p>
      <p><span class="font-semibold text-gray-800">Nama Pelanggan:</span> {{ $pesanan->pelanggan->nama_pelanggan }}</p>
      <p><span class="font-semibold text-gray-800">Nomor Meja:</span> {{ $pesanan->tempatDuduk->nomor_tempat }}</p>
    </div>

    <!-- List Menu -->
    <div class="mb-6 text-left">
      <h3 class="text-lg font-semibold text-gray-800 mb-3">Menu yang Dipesan</h3>
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-gray-100 text-gray-700 text-sm">
            <th class="border px-3 py-2 text-left">Menu</th>
            <th class="border px-3 py-2 text-center">Jumlah</th>
            <th class="border px-3 py-2 text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pesanan->detailPemesanan as $item)
              <tr class="hover:bg-gray-50 transition">
                <td class="border px-3 py-2">{{ $item->menu->nama_menu }}</td>
                <td class="border px-3 py-2 text-center">{{ $item->jumlah_pesanan }}</td>
                <td class="border px-3 py-2 text-right">Rp{{ number_format($item->menu->harga * $item->jumlah_pesanan, 0, ',', '.') }}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="">
        <span class="font-semibold">Total Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
    </div>

    <!-- Barcode -->
    <div class="mt-5 flex justify-center">{!! $qrcode !!}</div>
    {{-- <p class="text-sm text-gray-500 mb-6">Tunjukkan barcode ini ke kasir untuk konfirmasi pesanan.</p> --}}

    <!-- Tombol kembali -->
    <div class="mt-8">
      <a href="{{ url('/pesan/' . $pesanan->tempatDuduk->nomor_tempat) }}"
         class="penguin-btn penguin-btn-primary px-6 py-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition-all duration-200">
         Kembali ke Menu
      </a>
    </div>
  </div>

</body>
</html>
