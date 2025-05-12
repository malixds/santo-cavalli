<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function getPage()
    {
        return view('pages.design');
    }

    public function storeDesign()
    {
        //
    }
}
