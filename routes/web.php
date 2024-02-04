<?php

use App\Enums\Role;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/siswa/login', [PageController::class, 'login'])->name('guest.login');
Route::post('/siswa/login', [PageController::class, 'authentication'])->name('guest.auth');
Route::post('/siswa/logout', [PageController::class, 'logout'])->name('guest.logout');
Route::get('/siswa/{siswa}/history', [PageController::class, 'history'])->name('guest.history');


Route::middleware('auth')->group(function () {
    Route::get('/', [PageController::class, 'index'])
        ->name('dashboard');

    Route::get('pembayaran/{siswa}', [PembayaranController::class, 'index'])
        ->name('pembayaran.index');

    Route::get('pembayaran/{siswa}/print', [PembayaranController::class, 'print'])
        ->name('pembayaran.print');

    Route::post('pembayaran/{siswa}', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');

    Route::get('pembayaran/{siswa}/create', [PembayaranController::class, 'create'])
        ->name('pembayaran.create');

    Route::resource('siswa', SiswaController::class)
        ->middleware('role:' . Role::ADMIN->value)
        ->except(['show']);

    Route::resource('kelas', KelasController::class)
        ->middleware('role:' . Role::ADMIN->value)
        ->except(['show']);

    Route::resource('petugas', PetugasController::class)
        ->middleware('role:' . Role::ADMIN->value)
        ->except(['show']);

    Route::resource('bayar', SppController::class)
        ->middleware('role:' . Role::ADMIN->value)
        ->except(['show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
