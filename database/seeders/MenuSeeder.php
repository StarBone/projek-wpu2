<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::insert([
            ['kategori' => 'makanan', 'nama_menu' => 'Mie Pedas Level 1', 'deskripsi' => 'Mie pedas ringan', 'harga' => 15000],
            ['kategori' => 'makanan', 'nama_menu' => 'Mie Pedas Level 5', 'deskripsi' => 'Pedas menggigit', 'harga' => 18000],
            ['kategori' => 'minuman', 'nama_menu' => 'Es Teh Manis', 'deskripsi' => 'Segar dan manis', 'harga' => 5000],
        ]);
    }
}
