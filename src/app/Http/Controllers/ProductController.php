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
            ->with(['category', 'images'])
            ->get();

        return view('pages.products.products', [
            'products' => $products,
        ]);
    }

    public function getOneProduct(string $uuid)
    {
        $product = Product::query()->where('uuid', $uuid)->first();

        return view('pages.products.product', [
            'product' => $product,
        ]);
    }
}

//
//@foreach($product->images as $image)
//                                <p>{{$image}}</p>
//                                <div class="w-full flex-shrink-0">
//                                    <img src="{{ asset($image->urls) }}" alt="{{ $product->name }}"
//                                         class="w-full h-full object-cover">
//                                </div>
//@endforeach
