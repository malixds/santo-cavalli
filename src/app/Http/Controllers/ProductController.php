<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
    }

    public function getProductsByCategory(string $category)
    {
        $category = Category::query()->where('name', $category)->first();
        $products = Product::query()
            ->where('category_id', $category->id)
            ->with('category')
            ->get();


        return view('pages.products', [
            'products' => $products,
        ]);
    }
}
