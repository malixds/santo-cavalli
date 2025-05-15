<?php

use App\Http\Controllers\ProductController;
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
    Route::get('/{category}', [ProductController::class, 'getProductsByCategory'])->name('category.get-all-products');
    Route::prefix('products')->group(function () {
        Route::get('{uuid}', [ProductController::class, 'getOneProduct'])->name('product.get-one');
    });
    Route::get('/', [CategoryController::class, 'getAllCategories'])->name('category.get');
});

Route::prefix('collections')->group(function () {
    Route::get('/', [CollectionController::class, 'getLastCollection'])->name('collection.get');;
});

Route::prefix('designs')->group(function () {
    Route::get('/', [DesignController::class, 'getPage'])->name('design.page-get');
    Route::post('/store', [DesignController::class, 'storeDesign'])->name('designs.store');
});




