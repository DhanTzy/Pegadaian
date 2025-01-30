<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Nasabah\NasabahController;
use App\Http\Controllers\Karyawan\KaryawanController;
use App\Http\Controllers\Karyawan\PekerjaanController;
use App\Http\Controllers\Transaksi\TransaksiController;
use App\Http\Controllers\Transaksi\AppraisalController;
use App\Http\Controllers\Transaksi\ApprovalController;
use App\Http\Controllers\HomeController;
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
    return redirect()->route('login');
});

Route::controller(AuthController::class)->group(function () {
    // Route::get('register', 'register')->name('register');
    // Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

//Admin Routes List
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Kelola Akun
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/data', [UserController::class, 'getData'])->name('users.data');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('auth/password', function () {
        return view('auth.password');
    })->name('auth.password');
    Route::get('password/change', [AuthController::class, 'changePassword'])->name('password.change');
    Route::post('password/change', [AuthController::class, 'changePasswordSave'])->name('password.change.save');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Nasabah
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah.index');
    Route::get('/nasabah/create', [NasabahController::class, 'create'])->name('nasabah.create');
    Route::post('/nasabah/store', [NasabahController::class, 'store'])->name('nasabah.store');
    Route::delete('/nasabah/destroy/{id}', [NasabahController::class, 'destroy'])->name('nasabah.destroy');
    Route::get('/nasabah/data', [NasabahController::class, 'getData'])->name('nasabah.data');

    // { --
    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('/transaksi/data', [TransaksiController::class, 'getData'])->name('transaksi.data');
    // Cetak
    Route::get('/transaksi/cetak', [CetakController::class, 'index'])->name('cetak.index');

    // Appraisal Routes masih satu kolom dengan transaksi cuman kepisah aja ada yang kolomnya di transaksi ada yang di appraisal
    Route::get('/appraisal', [AppraisalController::class, 'index'])->name('appraisal.index');
    Route::get('/appraisal/data', [AppraisalController::class, 'getData'])->name('appraisal.data');
    Route::get('/appraisal/{id}/edit', [AppraisalController::class, 'edit'])->name('appraisal.edit');
    Route::put('/appraisal/{id}', [AppraisalController::class, 'update'])->name('appraisal.update');

    // Approval Routes masih satu kolom dengan transaksi cuman kepisah aja ada yang kolomnya di transaksi ada yang di approval
    Route::get('/approval', [ApprovalController::class, 'index'])->name('approval.index');
    Route::get('/approval/data', [ApprovalController::class, 'getData'])->name('approval.data');
    Route::get('/approval/{id}/edit', [ApprovalController::class, 'edit'])->name('approval.edit');
    Route::put('/approval/{id}', [ApprovalController::class, 'update'])->name('approval.update');
    // } --

    // Karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/edit/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/destroy/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    Route::get('/karyawan/data', [KaryawanController::class, 'getData'])->name('karyawan.data');

    // Pekerjaan
    Route::get('/karyawan/pekerjaan', [pekerjaanController::class, 'index'])->name('karyawan.pekerjaan.index');
    Route::get('/karyawan/pekerjaan/create', [pekerjaanController::class, 'create'])->name('karyawan.pekerjaan.create');
    Route::post('/karyawan/pekerjaan', [pekerjaanController::class, 'store'])->name('karyawan.pekerjaan.store');
    Route::get('/karyawan/pekerjaan/{id}/edit', [pekerjaanController::class, 'edit'])->name('karyawan.pekerjaan.edit');
    Route::put('/karyawan/pekerjaan/{id}', [pekerjaanController::class, 'update'])->name('karyawan.pekerjaan.update');
    Route::delete('/karyawan/pekerjaan/{id}', [pekerjaanController::class, 'destroy'])->name('karyawan.pekerjaan.destroy');
});
