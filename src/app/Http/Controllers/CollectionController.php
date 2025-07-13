<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function getLastCollection()
    {
        $collection = Collection::query()->latest()->with('products')->first();
        return view('pages.newcollection', [
            'collection' => $collection,
        ]);
    }
}
