<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\MainController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\CollectionController;
use \App\Http\Controllers\DesignController;

Route::get('/', function () {
    return view('pages.main');
});


Route::get('/', [MainController::class, 'main'])->name('main.get');

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'getAllCategories'])->name('category.get');;
});

Route::prefix('collections')->group(function () {
    Route::get('/', [CollectionController::class, 'getLastCollection'])->name('collection.get');;
});

Route::prefix('designs')->group(function () {
    Route::get('/', [DesignController::class, 'getPage'])->name('design.page-get');
    Route::post('/', [DesignController::class, 'storeDesign'])->name('designs.store');
});
