<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Profile\AdminProfileController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Nasabah\NasabahController;
use App\Http\Controllers\Admin\Karyawan\KaryawanController;
use App\Http\Controllers\Admin\Karyawan\PekerjaanController;
use App\Http\Controllers\Admin\Transaksi\TransaksiController;
use App\Http\Controllers\Admin\Appraisal\AppraisalController;
use App\Http\Controllers\Admin\Approval\ApprovalController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Profile\UserProfileController;
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

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});



//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    // Dashboard
    Route::get('/admin/home', [DashboardController::class, 'adminHome'])->name('admin.home');

    // Nasabah
    Route::get('/admin/nasabah', [NasabahController::class, 'index'])->name('admin.nasabah');
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('admin.nasabah.index');
    Route::get('/admin/nasabah/create', [NasabahController::class, 'create'])->name('admin.nasabah.create');
    Route::post('/admin/nasabah/store', [NasabahController::class, 'store'])->name('admin.nasabah.store');
    Route::delete('/admin/nasabah/destroy/{id}', [NasabahController::class, 'destroy'])->name('admin.nasabah.destroy');
    Route::get('/admin/nasabah/data', [NasabahController::class, 'getData'])->name('admin.nasabah.data');

    // Transaksi
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/admin/transaksi/create', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
    Route::post('/admin/transaksi', [TransaksiController::class, 'store'])->name('admin.transaksi.store');
    Route::delete('/admin/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');
    Route::get('/admin/transaksi/data', [TransaksiController::class, 'getData'])->name('admin.transaksi.data');

    // Appraisal Routes
    Route::prefix('admin/appraisal')->name('admin.appraisal.')->group(function () {
        Route::get('/', [AppraisalController::class, 'index'])->name('index');
        Route::get('/data', [AppraisalController::class, 'getData'])->name('data');
        Route::get('/{id}/edit', [AppraisalController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AppraisalController::class, 'update'])->name('update');
    });

    // Approval Routes
    Route::prefix('admin/approval')->name('admin.approval.')->group(function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('index');
        Route::get('/data', [ApprovalController::class, 'getData'])->name('data');
        Route::get('/{id}/edit', [ApprovalController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ApprovalController::class, 'update'])->name('update');
    });

    Route::get('auth/password', function () {
        return view('auth.password');
    })->name('auth.password');

    Route::get('password/change', [AuthController::class, 'changePassword'])->name('password.change');
    Route::post('password/change', [AuthController::class, 'changePasswordSave'])->name('password.change.save');

    // Profile
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::put('/admin/profile', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');

    // Karyawan
    Route::get('/admin/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan');
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan.index');
    Route::get('/admin/karyawan/create', [KaryawanController::class, 'create'])->name('admin.karyawan.create');
    Route::post('/admin/karyawan/store', [KaryawanController::class, 'store'])->name('admin.karyawan.store');
    Route::get('/admin/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('admin.karyawan.edit');
    Route::put('/admin/karyawan/edit/{id}', [KaryawanController::class, 'update'])->name('admin.karyawan.update');
    Route::delete('/admin/karyawan/destroy/{id}', [KaryawanController::class, 'destroy'])->name('admin.karyawan.destroy');
    Route::get('/admin/karyawan/data', [KaryawanController::class, 'getData'])->name('admin.karyawan.data');

    // Pekerjaan
    Route::get('/admin/karyawan/pekerjaan', [pekerjaanController::class, 'index'])->name('admin.karyawan.pekerjaan.index');
    Route::get('/admin/karyawan/pekerjaan/create', [pekerjaanController::class, 'create'])->name('admin.karyawan.pekerjaan.create');
    Route::post('/admin/karyawan/pekerjaan', [pekerjaanController::class, 'store'])->name('admin.karyawan.pekerjaan.store');
    Route::get('/admin/karyawan/pekerjaan/{id}/edit', [pekerjaanController::class, 'edit'])->name('admin.karyawan.pekerjaan.edit');
    Route::put('/admin/karyawan/pekerjaan/{id}', [pekerjaanController::class, 'update'])->name('admin.karyawan.pekerjaan.update');
    Route::delete('/admin/karyawan/pekerjaan/{id}', [pekerjaanController::class, 'destroy'])->name('admin.karyawan.pekerjaan.destroy');
});

// //Normal Users Routes List
// Route::middleware(['auth', 'user-access:user'])->group(function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');

//     // User Profil
//     Route::get('/user/profile', [UserProfileController::class, 'show'])->name('user.profile');
//     Route::put('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');


//     // Gadai Emas
//     Route::get('/gadaiemas', [UserController::class, 'gadaiemas'])->name('gadaiemas');

//     // History
//     Route::get('/history', [UserController::class, 'history'])->name('history');

//     // Cabang
//     Route::get('/cabang', [UserController::class, 'cabang'])->name('cabang');

//     // Membership
//     Route::get('/membership', [UserController::class, 'membership'])->name('membership');
// });
//

// Pajak
// Route::get('/admin/transaksi/pajak', [PajakController::class, 'index'])->name('admin.transaksi.pajak.index');
// Route::get('/admin/transaksi/pajak/create', [PajakController::class, 'create'])->name('admin.transaksi.pajak.create');
// Route::post('/admin/transaksi/pajak', [PajakController::class, 'store'])->name('admin.transaksi.pajak.store');
// Route::get('/admin/transaksi/pajak/{id}/edit', [PajakController::class, 'edit'])->name('admin.transaksi.pajak.edit');
// Route::put('/admin/transaksi/pajak/{id}', [PajakController::class, 'update'])->name('admin.transaksi.pajak.update');
// Route::delete('/admin/transaksi/pajak/{id}', [PajakController::class, 'destroy'])->name('admin.transaksi.pajak.destroy');