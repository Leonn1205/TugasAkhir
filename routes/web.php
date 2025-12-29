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
use App\Http\Controllers\KategoriKulinerController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserWisataController;
use App\Http\Controllers\UserKulinerController;
use Illuminate\Http\Request;

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

// ============================================================================
// PUBLIC ROUTES (User/Visitor)
// ============================================================================

Route::get('/', [HomeController::class, 'index'])->name('home');

// Wisata Public Routes
Route::get('/wisata', [UserWisataController::class, 'index'])->name('user.wisata.index');
Route::get('/wisata/{id}', [UserWisataController::class, 'show'])->name('user.wisata.show');

// Kuliner Public Routes
Route::get('/kuliner', [UserKulinerController::class, 'index'])->name('user.kuliner.index');
Route::get('/kuliner/{id}', [UserKulinerController::class, 'show'])->name('user.kuliner.show');

// Search & Map
Route::get('/search', [SearchController::class, 'searchAll'])->name('search');
Route::get('/map', [MapController::class, 'index'])->name('map');

// ============================================================================
// PUBLIC API ENDPOINTS (untuk Map/Mobile App)
// ============================================================================

Route::get('/api/wisata', [TempatWisataController::class, 'api'])->name('api.wisata');
Route::get('/api/kuliner', [TempatKulinerController::class, 'api'])->name('api.kuliner');

// ============================================================================
// AUTHENTICATION ROUTES
// ============================================================================

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================================================
// ADMIN & SUPER ADMIN ROUTES (Protected)
// ============================================================================

Route::middleware(['auth'])->group(function () {

    // Dashboard Routes (berdasarkan role)
    Route::middleware(['role:Super Admin,Admin'])->group(function () {
        Route::get('/dashboard_superadmin', [SuperAdminController::class, 'index'])
            ->name('dashboard.superadmin');
        Route::get('/dashboard_admin', [AdminController::class, 'index'])
            ->name('dashboard.admin');
    });

    // Admin Panel Routes (dengan prefix /dashboard)
    Route::prefix('dashboard')->middleware(['role:Super Admin,Admin'])->group(function () {

        // ============================================
        // TEMPAT WISATA MANAGEMENT
        // ============================================
        Route::resource('wisata', TempatWisataController::class)->names([
            'index'   => 'wisata.index',
            'create'  => 'wisata.create',
            'store'   => 'wisata.store',
            'show'    => 'wisata.show',
            'edit'    => 'wisata.edit',
            'update'  => 'wisata.update',
            'destroy' => 'wisata.destroy',
        ]);

        // Delete foto wisata individual
        Route::delete('wisata/foto/{id}', [TempatWisataController::class, 'deleteFoto'])
            ->name('wisata.foto.delete');

        // ============================================
        // TEMPAT KULINER MANAGEMENT
        // ============================================
        Route::resource('kuliner', TempatKulinerController::class)->names([
            'index'   => 'kuliner.index',
            'create'  => 'kuliner.create',
            'store'   => 'kuliner.store',
            'show'    => 'kuliner.show',
            'edit'    => 'kuliner.edit',
            'update'  => 'kuliner.update',
            'destroy' => 'kuliner.destroy',
        ]);

        // Delete foto kuliner individual
        Route::delete('kuliner/foto/{id}', [TempatKulinerController::class, 'deleteFoto'])
            ->name('kuliner.foto.delete');

        // ============================================
        // KATEGORI WISATA MANAGEMENT
        // ============================================
        Route::resource('kategori-wisata', KategoriWisataController::class)->names([
            'index'   => 'kategori-wisata.index',
            'create'  => 'kategori-wisata.create',
            'store'   => 'kategori-wisata.store',
            'show'    => 'kategori-wisata.show',
            'edit'    => 'kategori-wisata.edit',
            'update'  => 'kategori-wisata.update',
            'destroy' => 'kategori-wisata.destroy',
        ]);

        // Toggle status kategori wisata
        Route::post('kategori-wisata/{id}/toggle-status', [KategoriWisataController::class, 'toggleStatus'])
            ->name('kategori-wisata.toggle-status');

        // ============================================
        // KATEGORI KULINER MANAGEMENT
        // ============================================
        Route::resource('kategori-kuliner', KategoriKulinerController::class)->names([
            'index'   => 'kategori-kuliner.index',
            'create'  => 'kategori-kuliner.create',
            'store'   => 'kategori-kuliner.store',
            'show'    => 'kategori-kuliner.show',
            'edit'    => 'kategori-kuliner.edit',
            'update'  => 'kategori-kuliner.update',
            'destroy' => 'kategori-kuliner.destroy',
        ]);

        // Toggle status kategori kuliner
        Route::post('kategori-kuliner/{id}/toggle-status', [KategoriKulinerController::class, 'toggleStatus'])
            ->name('kategori-kuliner.toggle-status');

        // ============================================
        // EXPORT DATA
        // ============================================
        Route::get('/export/{tipe}', [ExportController::class, 'exportExcel'])
            ->name('export.excel');
    });

    // ============================================
    // SUPER ADMIN ONLY - USER MANAGEMENT
    // ============================================
    Route::middleware(['role:Super Admin'])->prefix('dashboard')->group(function () {
        Route::get('/admin', [SuperAdminController::class, 'indexAdmin'])
            ->name('superadmin.admin.index');
        Route::get('/admin/create', [SuperAdminController::class, 'createAdmin'])
            ->name('superadmin.admin.create');
        Route::post('/admin', [SuperAdminController::class, 'storeAdmin'])
            ->name('superadmin.admin.store');
        Route::get('/admin/{id}/edit', [SuperAdminController::class, 'editAdmin'])
            ->name('superadmin.admin.edit');
        Route::put('/admin/{id}', [SuperAdminController::class, 'updateAdmin'])
            ->name('superadmin.admin.update');
        Route::delete('/admin/{id}', [SuperAdminController::class, 'deleteAdmin'])
            ->name('superadmin.admin.delete');
    });
});

