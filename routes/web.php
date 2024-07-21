<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DetailTrackingController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

/**
 * Ruta publica de consulta para el cliente
 */
Route::get('/detail/tracking/{numberTracking}', [DetailTrackingController::class, 'index'])->name('detail.tracking.index');

/**
 * Rutas para el perfil
 */
Route::middleware(['auth:web', 'auth.logout', 'role:admin'])->prefix('profile')->group(function () {
    Route::get('/{id}', [UserController::class, 'profile'])->name('profile');
    Route::post('/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update');
});

/**
 * Rutas crud del rastreo
 */
Route::middleware(['auth:web', 'auth.logout'])->prefix('tracking')->group(function () {
    Route::get('/index', [TrackingController::class, 'index'])->name('tracking.index');
    Route::get('/create', [TrackingController::class, 'create'])->name('tracking.create');
    Route::get('/show/{trackingId}', [TrackingController::class, 'show'])->name('tracking.show');
    Route::post('/store', [TrackingController::class, 'store'])->name('tracking.store');
    Route::get('/edit/{trackingId}', [TrackingController::class, 'edit'])->name('tracking.edit');
    Route::put('/update/{trackingId}', [TrackingController::class, 'update'])->name('tracking.update');
    Route::delete('/delete/{trackingId}', [TrackingController::class, 'destroy'])->name('tracking.delete');
});
