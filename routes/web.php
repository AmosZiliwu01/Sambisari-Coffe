<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/product/{id}',[HomeController::class,'detailProduct'])->name('home.detailProduct');
Route::get('/page{id}',[HomeController::class,'detailPage'])->name('home.detailPage');
Route::get('/product',[HomeController::class,'semuaProduct'])->name('home.product');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');
    Route::get('/register', [AuthController::class, 'register'])->name('register.index');
    Route::post('/register', [AuthController::class, 'registerProceed'])->name('register.verify');
    Route::get('/register/activation/{token}', [AuthController::class, 'registerVerify']);
    Route::get('/forgot-password', [AuthController::class, 'forgotpassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'resetPasswordEmail'])->name('password.email');
    Route::get('/password/confirmation/{token}', [AuthController::class, 'showResetPasswordConfirmation'])->name('password.confirmation');
    Route::post('/password/update/{token}', [AuthController::class, 'updatePassword'])->name('password.update');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
});

Route::middleware(['auth:user'])->group(function () {
    Route::prefix('admin')->middleware('role:admin')->group(function (){
        Route::get('/',[DashboardController::class, 'index'])->name('dashboard.index')->middleware('role.admin');

        Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/tambah', [StaffController::class, 'tambah'])->name('staff.tambah');
        Route::post('/staff/prosesTambah', [StaffController::class, 'prosesTambah'])->name('staff.prosesTambah');
        Route::get('/staff/ubah/{id}', [StaffController::class, 'ubah'])->name('staff.ubah');
        Route::post('/staff/prosesUbah', [StaffController::class, 'prosesUbah'])->name('staff.prosesUbah');
        Route::get('/staff/hapus/{id}', [StaffController::class, 'hapus'])->name('staff.hapus');

        Route::get('/page',[PageController::class, 'index'])->name('page.index');
        Route::get('/page/tambah',[PageController::class, 'tambah'])->name('page.tambah');
        Route::post('/page/prosesTambah',[PageController::class, 'prosesTambah'])->name('page.prosesTambah');
        Route::get('/page/ubah/{id}',[PageController::class, 'ubah'])->name('page.ubah');
        Route::post('/page/prosesUbah',[PageController::class, 'prosesUbah'])->name('page.prosesUbah');
        Route::get('/page/hapus/{id}',[PageController::class, 'hapus'])->name('page.hapus');

        Route::get('/menu',[MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/tambah',[MenuController::class, 'tambah'])->name('menu.tambah');
        Route::post('/menu/prosesTambah',[MenuController::class, 'prosesTambah'])->name('menu.prosesTambah');
        Route::get('/menu/ubah/{id}',[MenuController::class, 'ubah'])->name('menu.ubah');
        Route::post('/menu/prosesUbah',[MenuController::class, 'prosesUbah'])->name('menu.prosesUbah');
        Route::get('/menu/hapus/{id}',[MenuController::class, 'hapus'])->name('menu.hapus');
        Route::get('/menu/order/{idMenu}/{idSwap}',[MenuController::class, 'order'])->name('menu.order');

        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');
   });
    Route::middleware(['role:kasir,pelanggan'])->group(function () {
        Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/detail/{id}', [PesananController::class, 'detail'])->name('pesanan.detail');
        Route::get('/pesanan/tambah', [PesananController::class, 'tambah'])->name('pesanan.tambah');
        Route::post('/pesanan/proses-tambah', [PesananController::class, 'prosesTambah'])->name('pesanan.prosesTambah');
        Route::get('/pesanan/{id}/ubah', [PesananController::class, 'ubah'])->name('pesanan.ubah');
        Route::post('/pesanan/{id}/proses-ubah', [PesananController::class, 'prosesUbah'])->name('pesanan.prosesUbah');
        Route::get('/pesanan/hapus/{id}', [PesananController::class, 'hapus'])->name('pesanan.hapus');
        Route::get('/pesanan/{id}/status/{status}', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
        Route::get('/pesanan/delete-all', [PesananController::class, 'deleteAll'])->name('pesanan.deleteAll');
    });

    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');
        Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');
        Route::get('/profile/updateProfile',[UserController::class, 'updateProfile'])->name('user.updateProfile');
        Route::post('/profile/prosesUpdateProfile',[UserController::class, 'prosesUpdateProfile'])->name('user.prosesUpdateProfile');

        Route::get('/reset-password',[DashboardController::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password',[DashboardController::class, 'prosesResetPassword'])->name('dashboard.prosesResetPassword');


    Route::group(['prefix' => 'app', 'middleware' => 'role:kasir'], function () {
        Route::get('/', [KasirController::class, 'index'])->name('kasir.index');
        Route::post('/search-barcode', [KasirController::class, 'searchProduct']);
        Route::post('/insert', [KasirController::class, 'insert']);
        Route::get('transaksi/{id}/status/{status}', [KasirController::class, 'updateStatus'])->name('transaksi.updateStatus');
        Route::get('/transaksi/delete-all', [KasirController::class, 'deleteAll'])->name('transaksi.deleteAll');
    });

    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/', [TransaksiController::class, 'index']);
        Route::get('transactions/pdf', [TransaksiController::class, 'generatePDF'])->name('transactions.pdf');
        Route::get('/transaksi/delete/{id}', [TransaksiController::class, 'delete'])->name('transaksi.delete');

        Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori.index');
        Route::middleware(['role:admin,kasir'])->group(function () {
            Route::get('/kategori/tambah',[KategoriController::class, 'tambah'])->name('kategori.tambah');
            Route::post('/kategori/prosesTambah',[KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');
            Route::delete('/products/{id}/permanently-delete', [ProductController::class, 'destroyPermanently'])->name('products.permanently-delete');
            Route::get('/produk/terhapus', [ProductController::class, 'trashedProducts'])->name('produk.terhapus');
            Route::delete('/produk/hapus-permanent/{id}', [ProductController::class, 'deletePermanent'])->name('product.delete-permanent');
            Route::put('/produk/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
        });
        Route::get('/kategori/ubah/{id}',[KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah',[KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}',[KategoriController::class, 'hapus'])->name('kategori.hapus');

        Route::middleware(['role:admin,kasir'])->group(function () {
            Route::get('/product/tambah',[ProductController::class, 'tambah'])->name('product.tambah');
            Route::post('/product/prosesTambah',[ProductController::class, 'prosesTambah'])->name('product.prosesTambah');
        });
        Route::get('/product',[ProductController::class, 'index'])->name('product.index');
        Route::get('/product/ubah/{id}',[ProductController::class, 'ubah'])->name('product.ubah');
        Route::post('/product/prosesUbah',[ProductController::class, 'prosesUbah'])->name('product.prosesUbah');
        Route::get('/product/hapus/{id}',[ProductController::class, 'hapus'])->name('product.hapus');
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
