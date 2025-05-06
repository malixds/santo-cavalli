<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        return view('pages.categories');
    }
}
