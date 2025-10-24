<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatDuduk extends Model
{
    /** @use HasFactory<\Database\Factories\TempatDudukFactory> */
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
