<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MidtransController;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('/hasilpencarian', [ProgramController::class, 'hasilCari']);
Route::get('/semuaprogram', [ProgramController::class, 'index']);
Route::get('/urutmendesak', [ProgramController::class, 'urutMendesak']);
Route::get('/urutterbaru', [ProgramController::class, 'urutTerbaru']);
Route::get('programs/{program:id}', [ProgramController::class, 'show']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categoriesdesak/{category}', [CategoryController::class, 'showmendesak']);
Route::get('/categoriesbaru/{category}', [CategoryController::class, 'showterbaru']);

// User Regis
Route::post('/regis', [RegisterController::class, 'store']);

// Login-Logout
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Google Login
Route::get('/auth/redirect', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/callback', [GoogleController::class, 'handleGoogleCallback']);

// Middleware cek role
Route::group(['middleware' => 'auth'], function() {

    // Halaman yang bisa diakses oleh Admin
    Route::group(['middleware' => 'cekrole:admin'], function() {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/tblprogram', [AdminController::class, 'tabelprogram']);
    });

    // Halaman yang bisa diakses oleh Customer
    Route::group(['middleware' => 'cekrole:pengunjung'], function() {
        Route::get('/profile', [UserController::class, 'profile']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/form-donasi/{program}', [DonasiController::class, 'index']);
        Route::post('/newToken', [MidtransController::class, 'newToken']);
        Route::get('/formprogram', [DonasiController::class, 'galangdana']);
    });
});

// Filter Program Mendesak
Route::get('/getDesakSemua', [ProgramController::class, 'getDesakSemua']);
Route::get('/getDesakSehat', [ProgramController::class, 'getDesakSehat']);
Route::get('/getDesakPendidikan', [ProgramController::class, 'getDesakPendidikan']);
Route::get('/getDesakBencana', [ProgramController::class, 'getDesakBencana']);

// Filter Program Terbaru
Route::get('/getBaruSemua', [ProgramController::class, 'getBaruSemua']);
Route::get('/getBaruSehat', [ProgramController::class, 'getBaruSehat']);
Route::get('/getBaruPendidikan', [ProgramController::class, 'getBaruPendidikan']);
Route::get('/getBaruBencana', [ProgramController::class, 'getBaruBencana']);

// Progress Bar
Route::get('/getprogram', [ProgramController::class, 'getprogram']);

// Update User
Route::put('/profil/{id}', [UserController::class, 'update']);
// Update Password User
Route::put('/ubahpw', [UserController::class, 'updatepw']);


