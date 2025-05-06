<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\MainController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\CollectionController;

Route::get('/', function () {
    return view('pages.main');
});


Route::get('/', [MainController::class, 'main'])->name('main.get');
Route::get('/categories', [CategoryController::class, 'getAllCategories'])->name('category.get');
Route::get('/collections', [CollectionController::class, 'getLastCollection'])->name('collection.get');
