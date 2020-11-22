<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WisataController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['auth', 'CheckRole:wisatawan,pengelola_wisata']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('user')->name('user.')->group(function () {
        Route::put('/update', [UserController::class, 'update'])->name('update');
        Route::get('/data/{role}', [UserController::class, 'all'])->name('all');
        Route::get('/{user?}', [UserController::class, 'index'])->name('index');

    });
    Route::prefix('wisata')->name('wisata.')->group(function () {
        Route::get('/all',[WisataController::class,'all'])->name('data');
        Route::put('/konfirmasi/{act}',[WisataController::class,'konfirmasi'])->name('konfirmasi');
        Route::get('/pengajuan',[WisataController::class,'pengajuan'])->name('pengajuan');
        Route::post('/pengajuan',[WisataController::class,'store']);
    });
});