<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    /** @use HasFactory<\Database\Factories\PelangganFactory> */
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_pelanggan');
    }
}
