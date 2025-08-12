<?php

use App\Http\Controllers\DesignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/designs')->group(function () {
    Route::post('/send', [DesignController::class, 'sendDesignByUser'])->name('design.user-send');
    Route::post('/get', [DesignController::class, 'getAllUsersDesigns'])->name('design.user-get-all');
    Route::prefix('/admins')->group(function () {
        Route::get('/show/{design?}', [DesignController::class, 'getDesigns'])->name('design.admin-get');
        Route::get('/handle/{design}', [DesignController::class, 'getDesigns'])->name('design.admin-get');
    });
});
