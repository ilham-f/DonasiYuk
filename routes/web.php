<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Customer tanpa login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ObatController::class, 'index']);
Route::get('produk/{obat:slug}', [ObatController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('categories/{category:slug}', [CategoryController::class, 'show']);

// User Regis
Route::post('/regis', [RegisterController::class, 'store']);

// Customer Login-Logout
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
// Google Login
Route::get('/auth/redirect', [GoogleController::class, 'redirectToGoogle']);
Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Middleware cek role
Route::group(['middleware' => 'auth'], function() {

    // Halaman yang bisa diakses oleh Admin
    Route::group(['middleware' => 'cekrole:admin'], function() {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/tabelobat', [AdminController::class, 'tabelobat']);
        Route::get('/tambahobat', [AdminController::class, 'tambahobat']);
        Route::get('/tabelkategori', [AdminController::class, 'tabelkategori']);
        Route::get('/tambahkategori', [AdminController::class, 'tambahkategori']);
        Route::get('/tabelkeluhan', [AdminController::class, 'tabelkeluhan']);
        Route::get('/tambahkeluhan', [AdminController::class, 'tambahkeluhan']);
    });

    // Halaman yang bisa diakses oleh Customer
    Route::group(['middleware' => 'cekrole:customer'], function() {
        Route::get('/afterpmblian', [TransaksiController::class, 'after'])->name('after');
        Route::get('/kirimresep', [UserController::class, 'resep']);
        Route::get('/profile', [UserController::class, 'profile']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/rwytpmblian', [TransaksiController::class, 'index']);
        Route::get('/keranjang', [CartController::class, 'index'])->name('cart.list');
        Route::post('/detailproduk', [CartController::class, 'addToCart'])->name('cart.store');
        Route::post('cart-remove', [CartController::class, 'removeCart'])->name('cart.remove');
        Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
        Route::post('/keranjang', [TransaksiController::class, 'buat'])->name('transaksi.store');
        Route::get('pembelian/{transaksi:id}', [TransaksiController::class, 'show']);
        Route::post('cart-clear', [CartController::class, 'clearCart'])->name('cart.clear');
    });
});

// Create, Update, Delete tabel obat
Route::post('/tambahobat', [ObatController::class, 'store'])->name('tambahobat');
Route::put('/tabelobat/{id}', [ObatController::class, 'update']);
Route::delete('/tabelobat/{id}', [ObatController::class, 'destroy']);

// Create, Update, Delete tabel keluhan
Route::post('/tambahkeluhan', [KeluhanController::class, 'store'])->name('tambahkeluhan');
Route::put('/tabelkeluhan/{id}', [KeluhanController::class, 'update']);
Route::delete('/tabelkeluhan/{id}', [KeluhanController::class, 'destroy']);

// Create, Update, Delete tabel kategori
Route::post('/tambahkategori', [CategoryController::class, 'store'])->name('tambahkategori');
Route::put('/tabelkategori/{id}', [CategoryController::class, 'update']);
Route::delete('/tabelkategori/{id}', [CategoryController::class, 'destroy']);

// Update User
Route::put('/profil/{id}', [UserController::class, 'update']);
// Update Password User
Route::put('/ubahpw', [UserController::class, 'updatepw']);
// Kirim Resep
Route::post('/kirimresep', [ResepController::class, 'store']);

