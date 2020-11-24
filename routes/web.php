<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\HargaWisataController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\XenditController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['auth', 'CheckRole:admin,pengelola_wisata,wisatawan']], function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/data/{role}', [UserController::class, 'all'])->name('all');
        Route::put('/update', [UserController::class, 'update'])->name('update');
        Route::get('/{user?}', [UserController::class, 'index'])->name('index');
    });
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/riwayat',[TransaksiController::class,'riwayat'])->name('riwayat');
    });
    Route::group(['middleware' => ['auth', 'CheckRole:admin,pengelola_wisata']], function () {
        Route::prefix('wisata')->name('wisata.')->group(function () {
            Route::get('/all', [WisataController::class, 'all'])->name('data');
            Route::get('detail/{wisata}', [WisataController::class, 'detail'])->name('detail');
            Route::put('/konfirmasi/{act?}', [WisataController::class, 'konfirmasi'])->name('konfirmasi');
            Route::get('/pengajuan', [WisataController::class, 'pengajuan'])->name('pengajuan');
            Route::put('/pengajuan', [WisataController::class, 'ajukan']);
            Route::get('/kelola', [WisataController::class, 'kelola'])->name('kelola');
            Route::put('/kelola/{wisata}', [WisataController::class, 'update'])->name('update');
            Route::delete('/delete/foto/{gallery}', [WisataController::class, 'destroyFoto'])->name('destroy-foto');
        });
        Route::prefix('bank')->name('bank.')->group(function () {
            Route::post('/create', [BankController::class, 'create'])->name('create');
            Route::put('/update/{bank}', [BankController::class, 'update'])->name('update');
            Route::post('/pencairan', [BankController::class, 'pencairan'])->name('pencairan');
        });
    });
    Route::group(['middleware' => ['auth', 'CheckRole:pengelola_wisata']], function () {
        Route::prefix('harga-wisata')->name('harga.')->group(function () {
            Route::post('/create/{wisata}', [HargaWisataController::class, 'create'])->name('create');
            Route::delete('/delete/{tiket}', [HargaWisataController::class, 'destroy'])->name('destroy');
        });
    });
});
