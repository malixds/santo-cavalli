<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignController;

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

// Design routes
Route::prefix('designs')->group(function () {
    Route::get('/', [DesignController::class, 'index'])->name('designs.index');
    Route::post('/', [DesignController::class, 'store'])->name('designs.store');
    Route::get('/{id}', [DesignController::class, 'show'])->name('designs.show');
    Route::put('/{id}', [DesignController::class, 'update'])->name('designs.update');
    Route::delete('/{id}', [DesignController::class, 'destroy'])->name('designs.destroy');
    Route::patch('/{id}/status', [DesignController::class, 'changeStatus'])->name('designs.change-status');
});
