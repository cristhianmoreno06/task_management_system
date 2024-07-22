<?php

use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\TaskApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Rutas para registro y consultas al Api
 */
Route::post('login', [LoginApiController::class, 'attemptLogin']);

/**
 * Rutas crud de las tareas
 */
Route::middleware(['auth:api'])->prefix('tasks')->group(function () {
    Route::get("listTask", [TaskApiController::class, 'listTask']);
    Route::post("storeTask", [TaskApiController::class, 'storeTask']);
    Route::put("updateTask/{taskId}", [TaskApiController::class, 'updateTask']);
    Route::delete("deleteTask/{taskId}", [TaskApiController::class, 'deleteTask']);
});
