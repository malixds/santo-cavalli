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

    public function search(Request $request)
    {
        $products = Product::query()
            ->with(['category', 'images']);

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'min') || str_contains($key, 'max')) {
                if (str_contains($key, 'min')) {
                    $products->where('price', '>=', $value);
                } else {
                    $products->where('price', '<=', $value);
                }
            } else if (is_array($value)) {
                $products->whereIn($key, $value);
            } else {
                $products->where($key, $value);
            }
        }

        $products = $products->get();

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
