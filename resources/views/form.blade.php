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
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Mie Gacoan</h2>
    <p class="text-center text-gray-500 mb-6">Silakan isi pesanan Anda di bawah ini</p>

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
          class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-400 penguin-input px-4 py-2">
      </div>

      <div class="flex justify-between items-center mb-4">
        <label class="font-semibold">Kategori:</label>
        <select id="filterKategori" class="select select-bordered w-1/2">
            <option value="all">Semua</option>
                @foreach ($kategori as $k)
                    <option value="{{ strtolower($k) }}">{{ ucfirst($k) }}</option>
                @endforeach
        </select>
      </div>

       <!-- Daftar menu -->
        <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Pilih Menu</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($menus as $menu)
            <div
                class="menu-item group flex flex-col rounded-lg overflow-hidden border border-neutral-300 bg-neutral-50 text-neutral-700 transition hover:shadow-lg hover:-translate-y-1 duration-300"
                data-category="{{ strtolower($menu->kategori ?? 'lainnya') }}"
            >
                <!-- Gambar -->
                <div class="h-44 md:h-56 overflow-hidden">
                <img src="{{ asset('storage/' . $menu->path_gambar) }}"
                    alt="{{ $menu->nama_menu }}"
                    class="object-cover w-full h-full transition duration-700 ease-out group-hover:scale-105">
                </div>

                <!-- Konten -->
                <div class="flex flex-col justify-between flex-1 p-5 gap-4">
                <div>
                    <div class="flex justify-between items-start">
                    <h3 class="text-lg font-bold text-neutral-900">
                        {{ $menu->nama_menu }}
                    </h3>
                    <span class="text-indigo-600 font-semibold">
                        Rp{{ number_format($menu->harga, 0, ',', '.') }}
                    </span>
                    </div>

                    <p class="mt-2 text-sm text-neutral-600">
                    {{ $menu->deskripsi ?? 'Menu spesial dengan rasa terbaik kami.' }}
                    </p>
                </div>

                <!-- Tombol Tambah & Jumlah -->
                <div class="flex items-center justify-between" data-harga="{{ $menu->harga }}">
                    <button type="button"
                            class="tambah flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M8 1.5a.75.75 0 0 1 .75.75v5h5a.75.75 0 0 1 0 1.5h-5v5a.75.75 0 0 1-1.5 0v-5h-5a.75.75 0 0 1 0-1.5h5v-5A.75.75 0 0 1 8 1.5Z" clip-rule="evenodd" />
                    </svg>
                    Tambah
                    </button>

                    <div class="flex items-center gap-2">
                    <button type="button"
                            class="minus bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex justify-center text-lg font-bold"
                            style="display:none;">-</button>
                    <input type="number" name="menu[{{ $menu->id }}]" value="0" min="0"
                            class="w-12 text-center border rounded-md py-1 bg-white penguin-input"
                            readonly style="display:none;">
                    <button type="button"
                            class="plus bg-green-100 hover:bg-green-200 text-green-600 rounded-full w-8 h-8 flex justify-center text-lg font-bold"
                            style="display:none;">+</button>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
        </div>
        </div>


      <!-- Tombol -->
      <div class="flex justify-between items-center mt-8 border-t pt-4">
        <span class="text-lg font-semibold text-gray-800">
          Total: Rp<span id="total-harga">-</span>
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
    // Filter kategori menu
    const filterKategori = document.getElementById('filterKategori');
    const menuItems = document.querySelectorAll('.menu-item');

    filterKategori.addEventListener('change', function() {
      const kategori = this.value;
      menuItems.forEach(item => {
        if (kategori === 'all' || item.dataset.category === kategori) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      });
    });

    // Hitung total harga
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

    items.forEach(item => {
      const tambahBtn = item.querySelector('.tambah');
      const minusBtn = item.querySelector('.minus');
      const plusBtn = item.querySelector('.plus');
      const input = item.querySelector('input');

      tambahBtn.addEventListener('click', () => {
        input.value = 1;
        input.style.display = '';
        minusBtn.style.display = '';
        plusBtn.style.display = '';
        tambahBtn.style.display = 'none';
        hitungTotal();
      });

      plusBtn.addEventListener('click', () => {
        input.value = parseInt(input.value) + 1;
        hitungTotal();
      });

      minusBtn.addEventListener('click', () => {
        if (parseInt(input.value) > 1) {
          input.value = parseInt(input.value) - 1;
          hitungTotal();
        } else if (parseInt(input.value) === 1) {
          input.value = 0;
          input.style.display = 'none';
          minusBtn.style.display = 'none';
          plusBtn.style.display = 'none';
          tambahBtn.style.display = '';
          hitungTotal();
        }
      });
    });
  </script>
</body>
</html>
