<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InterviewsController;
use App\Http\Controllers\SCPEnemiesController;
use App\Http\Controllers\SCPController;

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\InterviewsController as AdminInterviewsController;
use App\Http\Controllers\Admin\SCPEnemiesController as AdminSCPEnemiesController;
use App\Http\Controllers\Admin\SCPController as AdminSCPController;
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
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::post('/', [AdminSCPController::class, 'store'])->name('scp.store');
            Route::put('/{scp_id}', [AdminSCPController::class, 'update'])->name('scp.update');
        });
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/scp_ids', [AdminSCPController::class, 'getWithIds'])->name('scp.getWithIds');
    });

    Route::prefix('/category')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/{name}', [CategoryController::class, 'find'])->name('category.find');
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::post('/', [AdminCategoryController::class, 'store'])->name('category.store');
            Route::put('/{name}', [AdminCategoryController::class, 'update'])->name('category.update');
        });
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/category_ids', [AdminCategoryController::class, 'getWithIds'])->name('category.getWithIds');
    });

    Route::prefix('/interviews')->group(function () {
        Route::get('', [InterviewsController::class, 'index'])->name('interviews.index');
        Route::get('/{scp_id}', [AdminInterviewsController::class ,'getBySCP'])->name('interviews.getBySCP');
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::post('/', [AdminInterviewsController::class, 'store'])->name('interviews.store');
            Route::put('/{id}', [AdminInterviewsController::class, 'update'])->name('interviews.update');
        });
    });

    Route::prefix('/enemies')->group(function () {
        Route::get('{scp_id}', [SCPEnemiesController::class, 'find'])->name('scp_enemies.find');
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::post('/{scp_id}/enemy/{scp_enemy_id}', [AdminSCPEnemiesController::class, 'store'])->name('scp_enemies.store');
            Route::delete('/{scp_id}/enemy/{scp_enemy_id}', [AdminSCPEnemiesController::class, 'destroy'])->name('scp_enemies.destroy');
        });
    });
});
