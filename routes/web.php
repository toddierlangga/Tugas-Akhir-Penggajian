<?php

namespace App\Http\Controllers;
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

// Route::get('/', [Guest\HomeController::class, 'index'])->name('guest');
Route::get('/', [Auth\AuthController::class, 'index'])->name('login');
// Route::get('/loginverified/{id}/{data}', [Auth\AuthController::class, 'loginverified'])->name('loginverified');
Route::get('/logout', [Auth\AuthController::class, 'logout'])->name('logout');
Route::post('/auth', [Auth\AuthController::class, 'login'])->name('auth_login');

//error
Route::get('/error_401', [Auth\AuthController::class, 'error_401'])->name('error_401');

//level admin
Route::middleware('auth', 'validatelevels:admin')->group(function () {
    //get method
    Route::get('/admin/dashboard', [Admin\DashboardController::class, 'index']);

    Route::get('/admin/users/add', [Admin\ManagementController::class, 'index'])->name('add_users');
    Route::get('/admin/users/list', [Admin\ManagementController::class, 'show'])->name('list_users');
    Route::get('/admin/users/edit/{id}', [Admin\ManagementController::class, 'edit'])->name('edit_users');
    Route::get('/admin/users/hapus/{id}', [Admin\ManagementController::class, 'delete'])->name('hapus_users');

    //post method
    Route::post('/admin/users/store', [Admin\ManagementController::class, 'store'])->name('store_users');
    Route::post('/admin/barang/store', [Admin\BarangController::class, 'store'])->name('store_barang');
    Route::post('/admin/suppliers/store', [Admin\SuppliersController::class, 'store'])->name('store_supplier');

    //put method
    Route::put('/admin/users/update/{id}', [Admin\ManagementController::class, 'update'])->name('update_users');
    
});

//level keuangan
Route::middleware('auth', 'validatelevels:keuangan')->group(function () {
    //get method
    // Route::get('/keuangan/dashboard', [Keuangan\DashboardController::class, 'index']);
    Route::get('/keuangan/dashboard', [Keuangan\ManagementController::class, 'showTunjangan'])->name('list_tunjangan');
    Route::get('/keuangan/tunjangan/edit/{id}', [Keuangan\ManagementController::class, 'editTunjangan'])->name('edit_tunjangan');
    Route::get('/keuangan/slipgaji/store', [Keuangan\ManagementController::class, 'storeSlipGaji'])->name('create_slip_gaji');
    Route::get('/keuangan/showgaji', [Keuangan\ManagementController::class, 'showGaji'])->name('show_gaji');
    Route::get('/keuangan/printgaji/{id}', [Keuangan\ManagementController::class, 'printGaji'])->name('print_gaji');

    //put method
    Route::put('/keuangan/tunjangan/update/{id}', [Keuangan\ManagementController::class, 'updateTunjangan'])->name('update_tunjangan');
    
});

//level General Manager
Route::middleware('auth', 'validatelevels:gm')->group(function () {
    //get method
    // Route::get('/gm/dashboard', [GM\DashboardController::class, 'index']);
    Route::get('/gm/dashboard', [GM\ManagementController::class, 'showGaji'])->name('list_gaji');
    Route::get('/gm/gaji/validate', [GM\ManagementController::class, 'validateGaji'])->name('validate_slip_gaji');
    Route::get('/gm/laporan', [GM\ManagementController::class, 'showLaporanGaji'])->name('list_laporan');
    Route::get('/gm/pajak', [GM\ManagementController::class, 'showLaporanPajak'])->name('list_pajak');

    //post method
    Route::post('/gm/gaji/print', [GM\ManagementController::class, 'printLaporanGaji'])->name('store_gaji');
    Route::post('/gm/pajak/print', [GM\ManagementController::class, 'printLaporanPajak'])->name('store_pajak');

});

//level personalia
Route::middleware('auth', 'validatelevels:personalia')->group(function () {
    //get method
    // Route::get('/personalia/dashboard', [Personalia\DashboardController::class, 'index']);
    Route::get('/personalia/dashboard', [Personalia\ManagementController::class, 'showDivisi'])->name('list_divisi');
    Route::get('/personalia/divisi/add', [Personalia\ManagementController::class, 'addDivisi'])->name('add_divisi');
    Route::get('/personalia/divisi/edit/{id}', [Personalia\ManagementController::class, 'editDivisi'])->name('edit_divisi');
    Route::get('/personalia/divisi/hapus/{id}', [Personalia\ManagementController::class, 'deleteDivisi'])->name('hapus_divisi');

    Route::get('/personalia/jabatan', [Personalia\ManagementController::class, 'showJabatan'])->name('list_jabatan');
    Route::get('/personalia/jabatan/add', [Personalia\ManagementController::class, 'addJabatan'])->name('add_jabatan');
    Route::get('/personalia/jabatan/edit/{id}', [Personalia\ManagementController::class, 'editJabatan'])->name('edit_jabatan');
    Route::get('/personalia/jabatan/hapus/{id}', [Personalia\ManagementController::class, 'deleteJabatan'])->name('hapus_jabatan');

    Route::get('/personalia/karyawan', [Personalia\ManagementController::class, 'showKaryawan'])->name('list_karyawan');
    Route::get('/personalia/karyawan/add', [Personalia\ManagementController::class, 'addKaryawan'])->name('add_karyawan');
    Route::get('/personalia/karyawan/edit/{id}', [Personalia\ManagementController::class, 'editKaryawan'])->name('edit_karyawan');
    Route::get('/personalia/karyawan/hapus/{id}', [Personalia\ManagementController::class, 'deleteKaryawan'])->name('hapus_karyawan');
    Route::get('/personalia/import', [Personalia\ManagementController::class, 'import'])->name('import_karyawan');

    //post method
    Route::post('/personalia/karyawan/store', [Personalia\ManagementController::class, 'storeKaryawan'])->name('store_karyawan');
    Route::post('/personalia/jabatan/store', [Personalia\ManagementController::class, 'storeJabatan'])->name('store_jabatan');
    Route::post('/personalia/divisi/store', [Personalia\ManagementController::class, 'storeDivisi'])->name('store_divisi');
    Route::post('/personalia/import/store', [Personalia\ManagementController::class, 'storeImport'])->name('store_import');

    //put method
    Route::put('/personalia/karyawan/update/{id}', [Personalia\ManagementController::class, 'updateKaryawan'])->name('update_karyawan');
    Route::put('/personalia/divisi/update/{id}', [Personalia\ManagementController::class, 'updateDivisi'])->name('update_divisi');
    Route::put('/personalia/jabatan/update/{id}', [Personalia\ManagementController::class, 'updateJabatan'])->name('update_jabatan');
    
});
