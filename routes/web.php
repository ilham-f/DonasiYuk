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
use App\Http\Controllers\MailController;
use App\Http\Controllers\KabarTerbaruController;

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
// Reset Password
// Route::get('/forgot-password', [MailController::class, 'lupaPw'])->name('password.request');
Route::post('/forgot-password', [MailController::class, 'resetEmail'])->name('password.email');
Route::get('/reset-password/{token}', [MailController::class, 'resetView'])->name('password.reset');
Route::post('/reset-password', [MailController::class, 'resetPw'])->name('password.update');

// Customer tanpa login
Route::get('/', [HomeController::class, 'index'])->name('home');
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
// Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Google Login
Route::get('/auth/redirect', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/callback', [GoogleController::class, 'handleGoogleCallback']);

// Middleware cek role
Route::group(['middleware' => 'auth'], function() {

    // Verifikasi Email
    Route::get('/email/verify', [MailController::class, 'verify'])->name('verification.notice');
    Route::get('/email/verification-notification', [MailController::class, 'resend'])->middleware(['throttle:6,1'])->name('verification.send');
    Route::get('/email/verify/{id}/{hash}', [MailController::class, 'handler'])->middleware(['signed'])->name('verification.verify');

    // Halaman yang bisa diakses oleh Admin
    Route::group(['middleware' => 'cekrole:admin'], function() {
        // Dashboard
        Route::get('/admin', [AdminController::class, 'index']);

        // Manajemen Data
        Route::post('/ubahprogram', [AdminController::class, 'ubahprogram']);
        Route::get('/tbl-program', [AdminController::class, 'tabelprogram']);
        Route::get('/tbl-user', [AdminController::class, 'tabeluser']);
        Route::get('/tbl-transaksi', [AdminController::class, 'tabeltransaksi']);
        Route::get('/tbl-news', [AdminController::class, 'tabelnews']);
        Route::post('/tambahnews', [AdminController::class, 'create']);
        Route::post('/updatenews', [AdminController::class, 'update']);
        Route::post('/deletenews', [AdminController::class, 'delete']);
    });

    // Halaman yang bisa diakses oleh Customer
    Route::group(['middleware' => 'cekrole:pengunjung','verified'], function() {
        // Fitur User
        Route::get('/profile', [UserController::class, 'profile']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/programku', [UserController::class, 'programku']);
        Route::get('/rwytdonasi', [UserController::class, 'rwytdonasi']);
        Route::get('/form-donasi/{id}', [DonasiController::class, 'index']);
        Route::post('/newToken', [MidtransController::class, 'newToken']);
        Route::get('/form-program', [ProgramController::class, 'galangdana']);
        Route::post('/upProgram', [ProgramController::class, 'create']);
        Route::get('programku/{program:id}', [UserController::class, 'show']);
        Route::post('/programku/{id}', [ProgramController::class, 'update']);
        Route::post('/ubahAnonim', [UserController::class, 'ubahAnonim']);
        Route::get('/totalDonasi', [UserController::class, 'totalDonasi']);
        Route::post('/editFotoProgram/{id}', [ProgramController::class, 'editFotoProgram']);

        // Edit Kabar Terbaru
        Route::post('editkabar/{id}', [KabarTerbaruController::class, 'update']);
        Route::post('/tambahkabar', [KabarTerbaruController::class, 'create']);
        Route::post('/deletekabar', [KabarTerbaruController::class, 'delete']);
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

// Animate Number
Route::get('/getTotalDana', [AdminController::class, 'getTotalDana']);

// Update Profil
Route::put('/profil/{id}', [UserController::class, 'update']);
// Update Password User
Route::put('/ubahpw', [UserController::class, 'updatepw']);
// Reset Password User
Route::post('/lupaPw', [MailController::class, 'lupaPw']);
