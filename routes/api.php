<?php

use App\Http\Controllers\SCPController;
use App\Http\Middleware\VerifyCsrfToken;
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

Route::prefix('v1')->group(function () {
    Route::prefix('/scp')->group(function () {
        Route::get('', [SCPController::class, 'index'])->name('scp.index');
        Route::post('', [SCPController::class, 'store'])->name('scp.store');
        Route::get('/{scp_id}', [SCPController::class, 'find'])->name('scp.find');
        Route::put('/{scp_id}', [SCPController::class, 'update'])->name('scp.update');
    });
    //Route::prefix('/category')->group(function () {

    //});
    //Route::prefix('/interview')->group(function () {

    //});
});
