<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

// Admin
Route::middleware(CheckRole::class.':admin')->group(function (){
    //Dashboard 
    Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/admin-dashboard/submit', [AdminController::class, 'daftarAnggota'])->name('daftar.anggota');
    Route::post('/cek-duplikat', [AdminController::class, 'cekDuplikat'])->name('cek.duplikat');
    
    // Tabel Anggota
    Route::get('/admin-tabel-anggota',[AdminController::class, 'tabelAnggota'])->name('tabel.anggota');
    Route::get('/admin-tabel-anggota/{id}',[AdminController::class, 'editAnggota'])->name('edit.anggota');
    Route::post('/admin-tabel-anggota/{id}',[AdminController::class, 'updateAnggota'])->name('update.anggota');
    Route::post('/admin-tabel-anggota/delete/{id}', [AdminController::class, 'deleteAnggota'])->name('delete.anggota');

    // Pinjaman
    Route::get('/admin-pinjaman',[AdminController::class,'peminjaman'])->name('admin.peminjaman');
    Route::get('/search-user', [AdminController::class, 'search'])->name('search.user');
    Route::post('/admin/pinjaman1/', [AdminController::class, 'adminPinjaman1'])->name('admin.pinjaman1');
    Route::post('/admin/pinjaman2/', [AdminController::class, 'adminPinjaman2'])->name('admin.pinjaman2');

    // Overbook
    Route::get('/admin-overbook', [AdminController::class, 'overbook'])->name('admin.overbook');
    Route::get('/search-user-overbook', [AdminController::class, 'search_overbook'])->name('search.overbook');
    Route::post('/admin-overbook/overbook1/', [AdminController::class, 'adminOverbook1'])->name('admin.overbook1');
    Route::post('/admin-overbook/overbook2/', [AdminController::class, 'adminOverbook2'])->name('admin.overbook2');
    
    // Tabungan
    Route::get('/admin-penarikan-tabungan', [AdminController::class, 'penarikantabungan'])->name('admin.penarikantabungan');
    Route::get('/search-user-tabungan', [AdminController::class, 'search_tabungan'])->name('search.tabungan');
    Route::post('/admin-penarikan-tabungan/tabungan', [AdminController::class, 'adminTabungan'])->name('admin.tabungan');
    
    // Pembayaran Cicilan
    Route::post('/admin/proses-pembayaran', [AdminController::class, 'prosesPembayaran'])->name('admin.prosesPembayaran');
    Route::post('/admin/proses-pembayaran2', [AdminController::class, 'prosesPembayaran2'])->name('admin.prosesPembayaran2');
    Route::post('/admin/reset-bunga', [AdminController::class, 'resetBunga'])->name('admin.resetBunga');
    Route::get('/admin-pembayaran-cicilan', [AdminController::class, 'cicilan'])->name('admin.cicilan');
    Route::get('/search-user-cicilan', [AdminController::class, 'search_cicilan'])->name('search_cicilan');
    Route::post('/admin-cicilan-pembayaran/tabungan', [AdminController::class, 'adminCicilanTabungan'])->name('admin.cicilantabungan');

    // Edit Pembayaran
    Route::get('/admin-edit-cicilan', [AdminController::class, 'Edit'])->name('admin.edit');
    Route::get('/search-user-edit', [AdminController::class, 'search_edit'])->name('search_edit');
    Route::post('/update-peminjaman-by-date-tabungan', [AdminController::class, 'updateByDateTabungan'])->name('peminjaman.updateByDateTabungan');
    Route::post('/update-peminjaman-by-date', [AdminController::class, 'updateByDate'])->name('peminjaman.updateByDate');
    Route::post('/update-peminjaman-by-date2', [AdminController::class, 'updateByDate2'])->name('peminjaman.updateByDate2');

    // Pesan
    Route::get('/admin-pesan', [AdminController::class, 'Pesan'])->name('admin.Pesan');
    Route::get('/peminjaman-pesan-proses{pesan_id}',[AdminController::class, 'adminPesanPeminjaman1'])->name('admin.PesanPeminjaman1');
    Route::post('/admin-pesan-anggota/delete/{pesan_id}', [AdminController::class, 'adminDeletePesan'])->name('delete.pesan');
    Route::post('/admin-pesan-anggota/pesan-pinjaman/', [AdminController::class, 'adminPindahPinjaman'])->name('admin.PindahPinjaman');

    // Pengaturan
    Route::get('/admin-pengaturan', [AdminController::class, 'Pengaturan'])->name('admin.Pengaturan');
    Route::post('/ubah-password', [AdminController::class, 'ubahPassword'])->name('ubah.Password');
});

Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// User
Route::middleware(CheckRole::class.':user')->group(function(){

    // Dashboard
    Route::get('/dashboard',[UserController::class, 'userDashboard'])->name('user.dashboard');

    // Profile
    Route::get('/profile',[UserController::class, 'userProfile'])->name('user.profile');

    // Detail Keuangan
    Route::get('/detail-keuangan',[UserController::class, 'detailKeuangan'])->name('user.detailKeuangan');

    // Pinjaman
    Route::get('/peminjaman',[UserController::class, 'Pinjaman'])->name('user.Pinjaman');
    Route::post('/peminjaman-pesan',[UserController::class, 'userPesan1'])->name('user.Pesan1');

    // Overbook
    Route::get('/overbook',[UserController::class, 'Overbook'])->name('user.Overbook');

    // Penarikan Tabungan
    Route::get('/penarikan-tabungan',[UserController::class,'penarikanTabungan'])->name('user.penarikanTabungan');

    // Pengaturan
    Route::get('/pengaturan',[UserController::class,'Pengaturan'])->name('user.Pengaturan');
    Route::post('/user-ubah-password',[UserController::class,'userUbahPassword'])->name('user.Password');
});
