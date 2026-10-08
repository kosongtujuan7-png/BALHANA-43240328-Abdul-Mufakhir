<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('beranda');
});

Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

Route::get('/produk', [ProductController::class, 'index'])->name('produk');
Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
Route::put('/produk/{product}', [ProductController::class, 'update'])->name('produk.update');
Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('produk.destroy');

Route::get('/riset-pasar', function () {
    return view('riset-pasar');
})->name('riset-pasar');

Route::get('/analisis-minat', function () {
    return view('analisis-minat');
})->name('analisis-minat');

Route::get('/rekomendasi-restock', function () {
    return view('rekomendasi-restock');
})->name('rekomendasi-restock');

Route::get('/stok', function () {
    return view('stok');
})->name('stok');

Route::get('/pembelian', function () {
    return view('pembelian');
})->name('pembelian');

Route::get('/penjualan', function () {
    return view('penjualan');
})->name('penjualan');

Route::get('/keuangan', function () {
    return view('keuangan');
})->name('keuangan');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

Route::get('/pengaturan', function () {
    return view('pengaturan');
})->name('pengaturan');