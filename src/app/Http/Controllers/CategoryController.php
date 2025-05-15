<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::query()
            ->withCount('products')
            ->get();

        return view('pages.categories', [
            'categories' => $categories,
        ]);
    }
}
