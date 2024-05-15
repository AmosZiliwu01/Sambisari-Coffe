<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
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

Route::get('/login',[AuthController::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login',[AuthController::class, 'verify'])->name('auth.verify');

Route::get('/register',[AuthController::class, 'register'])->name('register.index')->middleware('guest');
Route::post('/register',[AuthController::class, 'registerProceed'])->name('register.verify');;
Route::get('/register/activation/{token}',[AuthController::class, 'registerVerify']);

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

        Route::get('/page',[App\Http\Controllers\PageController::class, 'index'])->name('page.index');
        Route::get('/page/tambah',[App\Http\Controllers\PageController::class, 'tambah'])->name('page.tambah');
        Route::post('/page/prosesTambah',[App\Http\Controllers\PageController::class, 'prosesTambah'])->name('page.prosesTambah');
        Route::get('/page/ubah/{id}',[App\Http\Controllers\PageController::class, 'ubah'])->name('page.ubah');
        Route::post('/page/prosesUbah',[App\Http\Controllers\PageController::class, 'prosesUbah'])->name('page.prosesUbah');
        Route::get('/page/hapus/{id}',[App\Http\Controllers\PageController::class, 'hapus'])->name('page.hapus');

        Route::get('/menu',[App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/tambah',[App\Http\Controllers\MenuController::class, 'tambah'])->name('menu.tambah');
        Route::post('/menu/prosesTambah',[App\Http\Controllers\MenuController::class, 'prosesTambah'])->name('menu.prosesTambah');
        Route::get('/menu/ubah/{id}',[App\Http\Controllers\MenuController::class, 'ubah'])->name('menu.ubah');
        Route::post('/menu/prosesUbah',[App\Http\Controllers\MenuController::class, 'prosesUbah'])->name('menu.prosesUbah');
        Route::get('/menu/hapus/{id}',[App\Http\Controllers\MenuController::class, 'hapus'])->name('menu.hapus');
        Route::get('/menu/order/{idMenu}/{idSwap}',[App\Http\Controllers\MenuController::class, 'order'])->name('menu.order');

        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
        Route::get('/feedback/tambah', [FeedbackController::class, 'tambah'])->name('feedback.formTambah');
        Route::post('/feedback/prosesTambah', [FeedbackController::class, 'prosesTambah'])->name('feedback.prosesTambah');
        Route::get('/feedback/list', [FeedbackController::class, 'list'])->name('feedback.list');
        Route::get('/feedback/hapus/{id}', [FeedbackController::class, 'hapus'])->name('feedback.hapus');

        Route::get('/berita',[App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
        Route::get('/berita/tambah',[App\Http\Controllers\BeritaController::class, 'tambah'])->name('berita.tambah');
        Route::post('/berita/prosesTambah',[App\Http\Controllers\BeritaController::class, 'prosesTambah'])->name('berita.prosesTambah');
        Route::get('/berita/ubah/{id}',[App\Http\Controllers\BeritaController::class, 'ubah'])->name('berita.ubah');
        Route::post('/berita/prosesUbah',[App\Http\Controllers\BeritaController::class, 'prosesUbah'])->name('berita.prosesUbah');
        Route::get('/berita/hapus/{id}',[App\Http\Controllers\BeritaController::class, 'hapus'])->name('berita.hapus');

        Route::get('/user', [FeedbackController::class, 'index'])->name('user.index');
        Route::get('/user/hapus/{id}', [FeedbackController::class, 'hapus'])->name('user.hapus');

    });

    Route::group(['prefix' => 'app', 'middleware' => 'auth'], function () {
        Route::get('/', [KasirController::class, 'index']);

        Route::post('/search-barcode', [KasirController::class, 'searchProduct']);
        Route::post('/insert', [KasirController::class, 'insert']);
    });

    Route::group(['prefix' => 'transaksi', 'middleware' => 'auth'], function () {
        Route::get('/', [TransaksiController::class, 'index']);
        Route::get('/{id}/pdf', [TransaksiController::class, 'printPDF']);
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
