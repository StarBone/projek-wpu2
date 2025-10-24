<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    /** @use HasFactory<\Database\Factories\DetailPesananFactory> */
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
