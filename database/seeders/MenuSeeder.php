<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::insert([
            ['kategori' => 'makanan', 'nama_menu' => 'Mie Gacoan Lv 1', 'deskripsi' => 'Mie pedas ringan', 'path_gambar' => 'image/Gacoan.webp', 'harga' => 15000],
            ['kategori' => 'makanan', 'nama_menu' => 'Mie Hompimpa Lv 5', 'deskripsi' => 'Pedas menggigit', 'path_gambar' => 'image/Hompimpa.webp', 'harga' => 18000],
            ['kategori' => 'minuman', 'nama_menu' => 'Es Teh Manis', 'deskripsi' => 'Segar dan manis', 'path_gambar' => 'image/EsTeh.webp', 'harga' => 5000],
        ]);
    }
}
