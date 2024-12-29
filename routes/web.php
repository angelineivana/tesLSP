<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

// Homepage route
Route::get('/', [KatalogController::class, 'index'])->name('katalog.index');

// Resource routes for Katalog and Peminjaman
Route::resource('katalog', KatalogController::class);
Route::put('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'returnBook'])->name('peminjaman.kembalikan');

Route::resource('peminjaman', PeminjamanController::class);

// Route for Anggota (Members)
Route::resource('anggotas', AnggotaController::class);

// Route for Buku (Books)
Route::resource('bukus', BukuController::class);
