<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Karyawan;
use App\Models\Nasabah;
use App\Models\Transaksi;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // User Profil
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::put('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');


    // Gadai Emas
    Route::get('/gadaiemas', [UserController::class, 'gadaiemas'])->name('gadaiemas');

    // History
    Route::get('/history', [UserController::class, 'history'])->name('history');

    // Cabang
    Route::get('/cabang', [UserController::class, 'cabang'])->name('cabang');

    // Membership
    Route::get('/membership', [UserController::class, 'membership'])->name('membership');
});

//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    // Dashboard
    Route::get('/admin/home', [DashboardController::class, 'adminHome'])->name('admin.home');

    // Transaksi
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/admin/transaksi/create', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
    Route::post('/admin/transaksi', [TransaksiController::class, 'store'])->name('admin.transaksi.store');
    Route::get('/admin/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
    Route::put('/admin/transaksi/{id}', [TransaksiController::class, 'update'])->name('admin.transaksi.update');
    Route::delete('/admin/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');
    Route::get('/admin/transaksi/data', [TransaksiController::class, 'getData'])->name('admin.transaksi.data');

    // Profile
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::put('/admin/profile', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');

    // Nasabah
    Route::get('/admin/nasabah', [NasabahController::class, 'index'])->name('admin.nasabah');
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('admin.nasabah.index');
    Route::get('/admin/nasabah/create', [NasabahController::class, 'create'])->name('admin.nasabah.create');
    Route::post('/admin/nasabah/store', [NasabahController::class, 'store'])->name('admin.nasabah.store');
    Route::get('/admin/nasabah/edit/{id}', [NasabahController::class, 'edit'])->name('admin.nasabah.edit');
    Route::put('/admin/nasabah/edit/{id}', [NasabahController::class, 'update'])->name('admin.nasabah.update');
    Route::delete('/admin/nasabah/destroy/{id}', [NasabahController::class, 'destroy'])->name('admin.nasabah.destroy');
    Route::get('/admin/nasabah/data', [NasabahController::class, 'getData'])->name('admin.nasabah.data');

    // Karyawan
    Route::get('/admin/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan');
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan.index');
    Route::get('/admin/karyawan/create', [KaryawanController::class, 'create'])->name('admin.karyawan.create');
    Route::post('/admin/karyawan/store', [KaryawanController::class, 'store'])->name('admin.karyawan.store');
    Route::get('/admin/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('admin.karyawan.edit');
    Route::put('/admin/karyawan/edit/{id}', [KaryawanController::class, 'update'])->name('admin.karyawan.update');
    Route::delete('/admin/karyawan/destroy/{id}', [KaryawanController::class, 'destroy'])->name('admin.karyawan.destroy');
    Route::get('/admin/karyawan/data', [KaryawanController::class, 'getData'])->name('admin.karyawan.data');
});
