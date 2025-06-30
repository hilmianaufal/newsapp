<?php

use App\Notifications\KomentarBaru;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminNotifController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\RegisteredUserController;

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

Route::get('', [FrontendController::class , 'index']);
Route::get('/detail/{slug}', [FrontendController::class , 'detail'])->name('detail');
Route::get('/search-suggestions', [ArtikelController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/kategori/{slug}' , [FrontendController::class , 'showKategori']);



Route::middleware('guest')->group(function(){

    Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
   
    Route::post('/artikel/{artikel}/komentar', [KomentarController::class, 'store'])->name('komentar.store');
});

Route::middleware('auth')->group(function(){

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::resource('kategoris', KategoriController::class)->middleware('auth');
    Route::resource('artikel', ArtikelController::class)->middleware('auth');
    Route::resource('playlist', PlaylistController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('slide', SlideController::class);
    Route::resource('iklan', IklanController::class);
    Route::resource('tag', TagController::class);
    Route::resource('user', UserController::class);
    Route::get('/select2-search', [SearchController::class, 'select2'])->name('select2.search');
    Route::resource('manajemen', ManajemenUserController::class);
    Route::get('/notification/{id}',[AdminNotifController::class, 'baca'])->name('notification.baca');
    Route::resource('komentar', KomentarController::class );
    Route::get('/pesan/kirim', [PesanController::class, 'form'])->name('pesan.form');
    Route::post('/pesan/kirim', [PesanController::class, 'kirimPesan'])->name('pesan.kirim');
    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/riwayat', [PesanController::class, 'riwayat'])->name('pesan.riwayat');
    Route::delete('/pesan/{id}/hapus', [PesanController::class, 'hapus'])->name('pesan.hapus');
    Route::get('/admin/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');


});



