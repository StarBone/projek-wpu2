<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    /** @use HasFactory<\Database\Factories\PesananFactory> */
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function detailPemesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }

    public function tempatDuduk()
    {
        return $this->hasOne(TempatDuduk::class, 'id_pesanan');
    }
}
