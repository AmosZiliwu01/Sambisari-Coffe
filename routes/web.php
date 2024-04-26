<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;

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
        Route::get('/',[DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile',[DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/reset-password',[DashboardController::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password',[DashboardController::class, 'prosesResetPassword'])->name('dashboard.prosesResetPassword');

        Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah',[KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori/prosesTambah',[KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');
        Route::get('/kategori/ubah/{id}',[KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah',[KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}',[KategoriController::class, 'hapus'])->name('kategori.hapus');
        Route::get('/kategori/export-pdf',[KategoriController::class, 'exportPdf'])->name('kategori.exportPdf');

        Route::get('/product',[ProductController::class, 'index'])->name('product.index');
        Route::get('/product/tambah',[ProductController::class, 'tambah'])->name('product.tambah');
        Route::post('/product/prosesTambah',[ProductController::class, 'prosesTambah'])->name('product.prosesTambah');
        Route::get('/product/ubah/{id}',[ProductController::class, 'ubah'])->name('product.ubah');
        Route::post('/product/prosesUbah',[ProductController::class, 'prosesUbah'])->name('product.prosesUbah');
        Route::get('/product/hapus/{id}',[ProductController::class, 'hapus'])->name('product.hapus');

        Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/tambah', [StaffController::class, 'tambah'])->name('staff.tambah');
        Route::post('/staff/prosesTambah', [StaffController::class, 'prosesTambah'])->name('staff.prosesTambah');
        Route::get('/staff/ubah/{id}', [StaffController::class, 'ubah'])->name('staff.ubah');
        Route::post('/staff/prosesUbah', [StaffController::class, 'prosesUbah'])->name('staff.prosesUbah');
        Route::get('/staff/hapus/{id}', [StaffController::class, 'hapus'])->name('staff.hapus');

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
