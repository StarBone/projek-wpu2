<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemesanan Meja {{ $nomor_tempat }}</title>

  <!-- TailwindCSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Penguin UI -->
  <script src="https://unpkg.com/@penguin-ui/core@latest"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-sky-100 to-blue-50 p-6">

  <div class="bg-white shadow-2xl rounded-2xl w-full max-w-2xl p-8 penguin-fade-in">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Pemesanan Meja {{ $nomor_tempat }}</h2>
    <p class="text-center text-gray-500 mb-6">Silakan isi pesanan Anda di bawah ini 👇</p>

    @if(session('success'))
      <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4 text-center">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" id="form-pesan">
      @csrf

      <!-- Nama pelanggan -->
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" required
          class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400 penguin-input px-4 py-2">
      </div>

      <!-- Daftar menu -->
      <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Pilih Menu</h3>

        @foreach($menus as $menu)
          <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl p-3 hover:bg-gray-100 transition penguin-card">
            <div>
              <p class="font-semibold text-gray-800">{{ $menu->nama_menu }}</p>
              <p class="text-sm text-gray-500">Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
            </div>
            <div class="flex items-center gap-2" data-harga="{{ $menu->harga }}">
              <button type="button" class="minus bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold">−</button>
              <input type="number" name="menu[{{ $menu->id }}]" value="0" min="0"
                     class="w-12 text-center border rounded-lg py-1 bg-white penguin-input" readonly>
              <button type="button" class="plus bg-green-100 hover:bg-green-200 text-green-600 rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold">+</button>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Total dan tombol -->
      <div class="flex justify-between items-center mt-8 border-t pt-4">
        <span class="text-lg font-semibold text-gray-800">
          Total: Rp<span id="total-harga">0</span>
        </span>
        <button type="submit"
          class="penguin-btn penguin-btn-primary bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full transition-all">
          Pesan Sekarang
        </button>
      </div>
    </form>
  </div>

  <!-- Script Hitung Total -->
  <script>
    const items = document.querySelectorAll('[data-harga]');
    const totalHargaEl = document.getElementById('total-harga');

    function hitungTotal() {
      let total = 0;
      items.forEach(item => {
        const harga = parseInt(item.dataset.harga);
        const jumlah = parseInt(item.querySelector('input').value);
        total += harga * jumlah;
      });
      totalHargaEl.textContent = total.toLocaleString('id-ID');
    }

    items
