<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pelanggan, Pesanan, DetailPesanan, Menu, TempatDuduk};
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PesananController extends Controller
{
    public function create($nomor_tempat)
    {
        $menus = Menu::all();
        $kategori = Menu::select('kategori')->distinct()->pluck('kategori');
        return view('form', compact('menus','kategori', 'nomor_tempat'));
    }

    public function store(Request $request, $nomor_tempat)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'menu' => 'required|array',
        ]);

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan
        ]);

        $pesanan = Pesanan::create([
            'nomor_order' => 'ORD-' . strtoupper(Str::random(6)),
            'id_pelanggan' => $pelanggan->id,
            'waktu_pesanan' => now(),
            'total_harga' => 0,
        ]);

        $total = 0;
        foreach ($request->menu as $id_menu => $jumlah) {
            if ($jumlah > 0) {
                $menu = Menu::find($id_menu);
                DetailPesanan::create([
                    'id_pesanan' => $pesanan->id,
                    'id_menu' => $menu->id,
                    'jumlah_pesanan' => $jumlah
                ]);
                $total += $menu->harga * $jumlah;
            }
        }

        $pesanan->update(['total_harga' => $total]);

        $tempat = TempatDuduk::where('nomor_tempat', $nomor_tempat)->first();
            if ($tempat) {
            $tempat->update(['id_pesanan' => $pesanan->id]);
            } else {
                TempatDuduk::create([
                    'nomor_tempat' => $nomor_tempat,
                    'id_pesanan' => $pesanan->id,
                ]);
            }

       return redirect()->route('pesan.sukses', ['nomor_order' => $pesanan->nomor_order]);
    }

    public function success($nomor_order)
    {
        $pesanan = Pesanan::with(['pelanggan', 'tempatDuduk', 'detailPemesanan.menu'])->where('nomor_order', $nomor_order)->firstOrFail();
        return view('sukses', compact('pesanan'));
    }

}
