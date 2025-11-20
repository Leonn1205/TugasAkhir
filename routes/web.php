<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TempatWisataController;
use App\Http\Controllers\TempatKulinerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriWisataController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SearchController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:Super Admin,Admin'])->group(function () {
        Route::get('/dashboard_superadmin', [SuperAdminController::class, 'index'])->name('dashboard.superadmin');
        Route::get('/dashboard_admin', [AdminController::class, 'index'])->name('dashboard.admin');

        Route::resource('dashboard/wisata', TempatWisataController::class);
        Route::resource('dashboard/kategori-wisata', KategoriWisataController::class);
        Route::resource('dashboard/kuliner', TempatKulinerController::class);
    });
});

Route::middleware(['auth', 'role:Super Admin'])->prefix('dashboard')->group(function () {
    Route::get('/admin', [SuperAdminController::class, 'indexAdmin'])->name('superadmin.admin.index');
    Route::get('/admin/create', [SuperAdminController::class, 'createAdmin'])->name('superadmin.admin.create');
    Route::post('/admin', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.admin.store');
    Route::get('/admin/{id}/edit', [SuperAdminController::class, 'editAdmin'])->name('superadmin.admin.edit');
    Route::put('/admin/{id}', [SuperAdminController::class, 'updateAdmin'])->name('superadmin.admin.update');
    Route::delete('/admin/{id}', [SuperAdminController::class, 'deleteAdmin'])->name('superadmin.admin.delete');
});

Route::get('/export/{tipe}', [ExportController::class, 'exportExcel'])->name('export.excel');

Route::get('/search', [SearchController::class, 'searchAll']);
