<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pesan/{nomor_tempat}', [PesananController::class, 'create']);
Route::post('/pesan/{nomor_tempat}', [PesananController::class, 'store']);
Route::get('/pesan/sukses/{nomor_order}', [PesananController::class, 'success'])->name('pesan.sukses');

