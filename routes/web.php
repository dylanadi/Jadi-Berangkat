<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinasiController as AdminDestinasiController;
use App\Http\Controllers\Admin\UlasanController as AdminUlasanController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\HalamanStatisController;
use App\Http\Controllers\Admin\MediaSosialController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\SeoSettingsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/privasi', [HomeController::class, 'privasi'])->name('privasi');
Route::get('/bantuan', [HomeController::class, 'bantuan'])->name('bantuan');

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{slug}', [DestinasiController::class, 'show'])->name('destinasi.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');

Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('destinasi', AdminDestinasiController::class);
    Route::resource('ulasan', AdminUlasanController::class)->except(['create', 'store']);
    Route::resource('galeri', AdminGaleriController::class);
    Route::resource('artikel', AdminArtikelController::class);
    Route::resource('media-sosial', MediaSosialController::class)->except(['create', 'show']);
    Route::resource('faq', FaqController::class)->except(['create', 'show']);
    Route::resource('kategori', KategoriController::class)->except(['create', 'show']);

    Route::get('halaman', [HalamanStatisController::class, 'index'])->name('halaman.index');
    Route::get('halaman/{halamanStatis}/edit', [HalamanStatisController::class, 'edit'])->name('halaman.edit');
    Route::match(['put', 'post'], 'halaman/{halamanStatis}', [HalamanStatisController::class, 'update'])->name('halaman.update');

    Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    Route::post('inline-update', [PengaturanController::class, 'inlineUpdate'])->name('inline.update');
    Route::post('inline-batch-save', [PengaturanController::class, 'batchSave'])->name('inline.batch-save');

    Route::get('seo', [SeoSettingsController::class, 'index'])->name('seo.index');
    Route::post('seo', [SeoSettingsController::class, 'update'])->name('seo.update');

    Route::post('upload-image', [PengaturanController::class, 'uploadImage'])->name('upload.image');
    Route::post('save-icon', [PengaturanController::class, 'saveIcon'])->name('save.icon');
    Route::get('images', [PengaturanController::class, 'listImages'])->name('images.list');
    Route::delete('delete-image/{image}', [PengaturanController::class, 'deleteImage'])->name('delete.image');
    Route::post('convert-webp', [PengaturanController::class, 'convertToWebp'])->name('convert.webp');
});

Route::middleware('auth')->get('/dashboard', function () {
    return redirect('/admin');
})->name('dashboard');

require __DIR__.'/auth.php';
