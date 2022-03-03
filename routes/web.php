<?php

use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/', function () {
    return view('home');
})->name('home');
Route::middleware('auth')->group(function(){
	Route::get('ganti-password', [App\Http\Controllers\AuthController::class, 'changePassword'])->name('user.change-password');
	Route::post('ganti-password', [App\Http\Controllers\AuthController::class, 'attemptChangePassword'])->name('user.change-password');
	Route::get('absensi', [App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi.index');
	Route::post('absensi/{pengunjung}', [App\Http\Controllers\AbsensiController::class, 'edit'])->name('absensi.edit');
	Route::patch('absensi/{pengunjung}', [App\Http\Controllers\AbsensiController::class, 'update'])->name('absensi.update');
	Route::resource('pendaftaran', App\Http\Controllers\PengunjungController::class);
	Route::get('pendaftaran/confirm-delete/{pengunjung}', [App\Http\Controllers\PengunjungController::class, 'confirmDelete'])->name('pendaftaran.confirm-delete');
	Route::get('pendaftaran/confirm-member/{pengunjung}', [App\Http\Controllers\PengunjungController::class, 'confirmMember'])->name('pendaftaran.confirm-member');
	Route::post('pendaftaran/add-to-member/{pengunjung}', [App\Http\Controllers\PengunjungController::class, 'addToMember'])->name('pendaftaran.add-to-member');
	Route::post('pendaftaran/remove-from-member/{pengunjung}', [App\Http\Controllers\PengunjungController::class, 'removeFromMember'])->name('pendaftaran.remove-from-member');
	Route::get('pendaftaran/confirm-delete-member/{pengunjung}', [App\Http\Controllers\PengunjungController::class, 'confirmDeleteMember'])->name('pendaftaran.confirm-delete-member');
	Route::resource('member', App\Http\Controllers\MemberController::class);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class)->only('create', 'index');
	Route::get('laporan-transaksi', [App\Http\Controllers\TransaksiController::class, 'laporan'])->name('transaksi.laporan');
	// Route::get('transaksi/confirm-delete/{transaksi}', [App\Http\Controllers\TransaksiController::class, 'confirmDelete'])->name('transaksi.confirm-delete');
	Route::resource('instruktur', App\Http\Controllers\InstrukturController::class);
	Route::get('instruktur/confirm-delete/{instruktur}', [App\Http\Controllers\InstrukturController::class, 'confirmDelete'])->name('instruktur.confirm-delete');
    Route::resource('laporan', App\Http\Controllers\LaporanController::class);
    Route::get('laporan-pengunjung', [PengunjungController::class, 'laporan'])->name('laporan-pengunjung');
    Route::get('buat-laporan', [PengunjungController::class, 'buatLaporan'])->name('buat-laporan');
});

Route::get('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('login', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('login');
Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
