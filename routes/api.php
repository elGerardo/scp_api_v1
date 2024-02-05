<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InterviewsController;
use App\Http\Controllers\SCPController;
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

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::prefix('v1')->group(function () {
    Route::prefix('/scp')->group(function () {
        Route::get('', [SCPController::class, 'index'])->name('scp.index');
        Route::get('/{scp_id}', [SCPController::class, 'find'])->name('scp.find');
        Route::group(['middleware' => 'auth:sanctum'], function() {
            Route::post('/', [SCPController::class, 'store'])->name('scp.store');
            Route::put('/{scp_id}', [SCPController::class, 'update'])->name('scp.update');
        });
    });
 
    Route::prefix('/category')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/{name}', [CategoryController::class, 'find'])->name('category.find');
        Route::group(['middleware' => 'auth:sanctum'], function() {
            Route::post('', [CategoryController::class, 'store'])->name('category.store');
            Route::put('/{name}', [CategoryController::class, 'update'])->name('category.update');
        });
    });
 
    Route::prefix('/interviews')->group(function () {
        Route::get('', [InterviewsController::class, 'index'])->name('interviews.index');
        Route::get('/{scp_id}', [InterviewsController::class, 'getBySCP'])->name('interviews.getBySCP');
        Route::group(['middleware' => 'auth:sanctum'], function() {
            Route::post('', [InterviewsController::class, 'store'])->name('interviews.store');
            Route::put('/{id}', [InterviewsController::class, 'update'])->name('interviews.update');
        });
    });
});
