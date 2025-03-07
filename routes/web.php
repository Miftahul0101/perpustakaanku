<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Models\Buku;
use App\Models\Mahasiswa;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuKategoriController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DendaController;
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Menampilkan daftar pengguna
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Form tambah pengguna
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Proses simpan pengguna baru
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show'); // Menampilkan detail pengguna
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Form edit pengguna
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Proses update pengguna
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Hapus pengguna
    // Route::resource('buku', BukuController::class);
    // Route::get('/buku/{buku}/qrcode/download', [BukuController::class, 'downloadQRCode'])->name('buku.qrcode.download');
    Route::resource('adminmahasiswa', AdminMahasiswaController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku-kategoris', BukuKategoriController::class);
    });


// Petugas Routes
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('petugas.dashboard');

    // routes/web.php
    
    Route::get('/buku/{id}/download-qr', [BukuController::class, 'downloadQR'])->name('buku.download-qr');
    // Route::resource('buku', BukuController::class);
    // Route::get('/buku/{buku}/qrcode/download', [BukuController::class, 'downloadQRCode'])->name('buku.download-qr');
    Route::resource('kategori', KategoriController::class);

    Route::get('/peminjaman/{id}/return', [PeminjamanController::class, 'return'])->name('peminjaman.return');
    Route::put('/peminjaman/{id}/confirm-return', [PeminjamanController::class, 'confirmReturn'])->name('peminjaman.confirm-return');

    });

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.index');
    Route::get('/profile/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/profile', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::get('/borrowing-history', [MahasiswaController::class, 'borrowingHistory'])
    ->name('mahasiswa.borrowing-history');
    Route::get('/peminjaman/scan', [PeminjamanController::class, 'index'])->name('peminjaman.scan');
    Route::get('/peminjaman/get-buku/{buku}', [PeminjamanController::class, 'getBuku'])->name('peminjaman.get-buku');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');

});
Route::get('/buku/scanner', [BukuController::class, 'scanner'])->name('buku.scanner');

Route::resource('buku', BukuController::class);
Route::get('buku/scan/{id}', [BukuController::class, 'scanQR'])->name('buku.scan');
Route::resource('peminjaman', PeminjamanController::class);
Route::get('peminjaman/return', [PeminjamanController::class, 'return'])->name('peminjaman.return');
Route::post('peminjaman/return', [PeminjamanController::class, 'processReturn'])->name('peminjaman.process-return');
Route::resource('denda', DendaController::class);
Route::post('denda/payment', [DendaController::class, 'processPayment'])->name('denda.process-payment');