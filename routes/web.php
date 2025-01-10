<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\GolonganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IzinCutiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RekapAbsensiController;
use App\Http\Controllers\OnPremiseController;
use App\Http\Controllers\QRCodeController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

// Route::middleware(['auth'])->group(function () {
Route::get('/krywn', function () {
    return view('layouts/master');
});
// Route untuk menampilkan semua karyawan
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
// Route untuk menampilkan form tambah karyawan
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/on-premise', [OnPremiseController::class, 'create'])->name('on-premise.create');
// Route untuk menampilkan form edit karyawan 
Route::get('/karyawan/edit/{karyawan}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
// Route untuk mengupdate karyawan
Route::post('/karyawan/update/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
// Route untuk menghapus karyawan
Route::get('/karyawan/delete/{karyawan}', [KaryawanController::class, 'delete'])->name('karyawan.delete');

//ROUTE UNTUK QR
Route::get('/generate-qrcode', [QRCodeController::class, 'generate'])->name('qr.form');
Route::get('/qr-scanner', [QRCodeController::class, 'scan'])->name('qr.scanner');
 Route::get('/qr-scanner/{code}', [QRCodeController::class, 'presensiqr'])->name('qr.process');

Route::get('rekapAll', [AbsensiController::class, 'index'])->name('rekapAll');
Route::get('/pencatatan', [AbsensiController::class, 'create'])->name('pencatatan.absensi');
Route::post('/pencatatan/store', [AbsensiController::class, 'store'])->name('pencatatan.store');
Route::post('/pencatatan/update/{absensi}', [AbsensiController::class, 'update'])->name('pencatatan.update');
Route::get('laporanAbsensi/{id?}', [RekapAbsensiController::class, 'index'])->name('laporanAbsensi');

// Golongan
Route::get('golongan', [GolonganController::class, 'index'])->name('golongan.index');
Route::get('/golongan/create', [GolonganController::class, 'create'])->name('golongan.create');
Route::post('/golongan/store', [GolonganController::class, 'store'])->name('golongan.store');
Route::get('/golongan/edit/{golongan}', [GolonganController::class, 'edit'])->name('golongan.edit');
Route::post('/golongan/update/{golongan}', [GolonganController::class, 'update'])->name('golongan.update');
Route::get('/golongan/delete/{golongan}', [GolonganController::class, 'destroy'])->name('golongan.delete');

// jabatan
Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
Route::get('/jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
Route::post('/jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
Route::get('/jabatan/edit/{jabatan}', [JabatanController::class, 'edit'])->name('jabatan.edit');
Route::post('/jabatan/update/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
Route::get('/jabatan/delete/{jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.delete');

// departemen
Route::get('departemen', [DepartemenController::class, 'index'])->name('departemen.index');
Route::get('/departemen/create', [DepartemenController::class, 'create'])->name('departemen.create');
Route::post('/departemen/store', [DepartemenController::class, 'store'])->name('departemen.store');
Route::get('/departemen/edit/{departemen}', [DepartemenController::class, 'edit'])->name('departemen.edit');
Route::post('/departemen/update/{departemen}', [DepartemenController::class, 'update'])->name('departemen.update');
Route::get('/departemen/delete/{departemen}', [DepartemenController::class, 'destroy'])->name('departemen.delete');

// role
Route::get('role', [RoleController::class, 'index'])->name('role.index');
Route::get('/role/create', [roleController::class, 'create'])->name('role.create');
Route::post('/role/store', [roleController::class, 'store'])->name('role.store');
Route::get('/role/edit/{role}', [roleController::class, 'edit'])->name('role.edit');
Route::post('/role/update/{role}', [roleController::class, 'update'])->name('role.update');
Route::get('/role/delete/{role}', [roleController::class, 'destroy'])->name('role.delete');
Route::get('/logout', [LoginController::class, 'logout']);
// });

Route::post('/absensi/authenticate', [AbsensiController::class, 'authenticate'])->name('absensi.authenticate');

