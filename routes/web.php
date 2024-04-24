<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
#tes git
Route::get('/', function () {
    return redirect()->route('auth.index');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');
});

Route::get('/register',[AuthController::class, 'register']);
Route::post('/register',[AuthController::class, 'registerProceed']);
Route::get('/register/activation/{token}',[AuthController::class, 'registerVerify']);
Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
});


Route::middleware(['auth:user'])->group(function () {
    Route::prefix('admin')->group(function (){
        Route::get('/',[App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile',[App\Http\Controllers\DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/reset-password',[App\Http\Controllers\DashboardController::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password',[App\Http\Controllers\DashboardController::class, 'prosesResetPassword'])->name('dashboard.prosesResetPassword');



        Route::get('/kategori',[App\Http\Controllers\KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah',[App\Http\Controllers\KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori/prosesTambah',[App\Http\Controllers\KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');
        Route::get('/kategori/ubah/{id}',[App\Http\Controllers\KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah',[App\Http\Controllers\KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}',[App\Http\Controllers\KategoriController::class, 'hapus'])->name('kategori.hapus');
        Route::get('/kategori/export-pdf',[App\Http\Controllers\KategoriController::class, 'exportPdf'])->name('kategori.exportPdf');

        Route::get('/product',[\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
        Route::get('/product/tambah',[App\Http\Controllers\ProductController::class, 'tambah'])->name('product.tambah');
        Route::post('/product/prosesTambah',[App\Http\Controllers\ProductController::class, 'prosesTambah'])->name('product.prosesTambah');
        Route::get('/product/ubah/{id}',[App\Http\Controllers\ProductController::class, 'ubah'])->name('product.ubah');
        Route::post('/product/prosesUbah',[App\Http\Controllers\ProductController::class, 'prosesUbah'])->name('product.prosesUbah');
        Route::get('/product/hapus/{id}',[App\Http\Controllers\ProductController::class, 'hapus'])->name('product.hapus');

        });
        Route::get('/Logout',[AuthController::class, 'Logout'])->name('auth.logout');
    });

Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('storage');
