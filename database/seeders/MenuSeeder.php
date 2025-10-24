<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::insert([
            ['nama_menu' => 'Mie Pedas Level 1', 'deskripsi' => 'Mie pedas ringan', 'harga' => 15000],
            ['nama_menu' => 'Mie Pedas Level 5', 'deskripsi' => 'Pedas menggigit', 'harga' => 18000],
            ['nama_menu' => 'Es Teh Manis', 'deskripsi' => 'Segar dan manis', 'harga' => 5000],
        ]);
    }
}
