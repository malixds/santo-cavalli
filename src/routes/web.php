<?php

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
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
    Route::get('/', [CategoryController::class, 'getAllCategories'])->name('category.get');
});
Route::prefix('products')->group(function () {
    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('{uuid}', [ProductController::class, 'getOneProduct'])->name('product.get-one');
});

Route::prefix('collections')->group(function () {
    Route::get('/all', [CollectionController::class, 'getAllCollections'])->name('collection.get-all');;
    Route::get('/{id?}', [CollectionController::class, 'getCollection'])->name('collection.get');;
});

Route::prefix('designs')->group(function () {
    Route::get('/', [DesignController::class, 'getPage'])->name('design.page-get');
    Route::post('/store', [DesignController::class, 'storeDesign'])->name('designs.store');
});

Route::prefix('authorization')->group(function () {
    Route::post('/', [AuthorizationController::class, 'authorization'])->name('authorization');
});

Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'addItem'])->name('cart.add-item');
    Route::get('/get', [CartController::class, 'getItemsInCart'])->name('cart.get-items');
});

Route::prefix('wishlist')->group(function () {
    Route::post('/add', [WishlistController::class, 'addItem'])->name('wishlist.add-item');
    Route::get('/get', [WishlistController::class, 'getItemsInWishlist'])->name('wishlist.get-items');
});




