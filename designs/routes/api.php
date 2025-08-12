<?php

use App\Http\Controllers\DesignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/designs')->group(function () {
    Route::post('/send', [DesignController::class, 'sendDesignByUser'])->name('design.user-send');
    Route::get('/get/{design?}', [DesignController::class, 'getAllUsersDesigns'])->name('design.user-get-all');
    Route::patch('/edit/{design}', [DesignController::class, 'editDesign'])->name('design.user-edit');
    Route::delete('/delete/design', [DesignController::class, 'deleteDesign'])->name('design.user-delete');
    Route::prefix('/admins')->group(function () {
        Route::get('/show/{design?}', [DesignController::class, 'getDesigns'])->name('design.admin-get');
        Route::patch('/handle/{design}', [DesignController::class, 'handleDesign'])->name('design.admin-handle');
    });
});
