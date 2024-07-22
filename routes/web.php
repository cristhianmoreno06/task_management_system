<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DetailTrackingController;
use App\Http\Controllers\TaskController;
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
 * Rutas para el perfil
 */
Route::middleware(['auth:web', 'auth.logout'])->prefix('profile')->group(function () {
    Route::get('/{id}', [UserController::class, 'profile'])->name('profile');
    Route::post('/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update');
});

/**
 * Rutas crud de las tareas
 */
Route::middleware(['auth:web', 'auth.logout'])->prefix('tasks')->group(function () {
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/show/{taskId}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/edit/{taskId}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/update/{taskId}', [TaskController::class, 'update'])->name('tasks.update');
    Route::post('/change-status/{taskId}', [TaskController::class, 'changeStatus'])->name('tasks.changeStatus');
    Route::get('/index', [TaskController::class, 'index'])->middleware('role:admin')->name('tasks.index');
    Route::delete('/delete/{taskId}', [TaskController::class, 'destroy'])->middleware('role:admin')->name('tasks.delete');
});
