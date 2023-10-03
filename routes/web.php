<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
//use App\http\Controllers\DashboardController;
use App\http\Controllers\ProdukController;
use App\http\Controllers\pelangganController;
use App\http\Controllers\PemasokController;
use App\http\Controllers\BarangController;
use App\http\Controllers\UserController;
use App\http\Controllers\PembelianController;
use App\http\Controllers\PembelianExport;

Route::get('/home',[HomeController::class, 'index' ]);
Route::get('/profile',[HomeController::class, 'profile' ]);
Route::get('/contact',[HomeController::class, 'contact' ]);
Route::get('/faq',[HomeController::class, 'faq' ]);
Route::get('/dashboard',[HomeController::class, 'dashboard']);
Route::get('/login',[UserController::class, 'index']) ->name('login');
Route::post('/login/cek',[UserController::class, 'cekLogin']) ->name('cekLogin');
Route::get('/logout',[UserController::class, 'logout']) ->name('logout');

Route::resource('produk', ProdukController::class);
Route::resource('barang', BarangController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('pemasok', PemasokController::class);
Route::resource('pembelian', PembelianController::class);

Route::group(['middleware'=>'auth'], function(){

    Route::get('/home',[HomeController::class, 'index' ]);
    Route::get('/profile',[HomeController::class, 'profile' ]);
    Route::get('/contact',[HomeController::class, 'contact' ]);
 
    Route::group(['middleware'=>['cekUserLogin:1']], function(){
        Route::resource('produk', ProdukController::class);
    });

    Route::group(['middleware'=>['cekUserLogin:2']], function(){
        Route::resource('pembelian', PembelianController::class);
        Route::get('history', [PembelianController::class, 'history']);
        Route::get('export/pembelian',[PembelianController::class, 'exportData'])->name('export-pembelian');
    });
});


//latihan 2

//Route::get('/',[DashboardController::class, 'index' ]);
//Route::get('/',[DashboardController::class, 'blog' ]);

