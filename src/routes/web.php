<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('pages.main');
});


Route::get('/', [MainController::class, 'main'])->name('main.get');
