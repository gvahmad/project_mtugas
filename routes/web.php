<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| ROUTE LOGIN (HANYA UNTUK TAMU)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| ROUTE YANG HARUS LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('admin', AdminController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('tugas', TugasController::class);

    // Halaman karyawan: menampilkan tugas yang diberikan oleh admin untuk karyawan tertentu
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::post('/karyawan/tugas/{id}/update-status', [KaryawanController::class, 'updateStatus'])->name('karyawan.tugas.updateStatus');

});
