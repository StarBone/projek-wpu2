<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function detailPemesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_menu');
    }
}
