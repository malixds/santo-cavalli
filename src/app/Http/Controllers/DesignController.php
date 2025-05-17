<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadDesignRequest;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function getPage()
    {
        return view('pages.design');
    }

    public function storeDesign(UploadDesignRequest $request)
    {

        // TODO: Сделать авторизацию пользователя по токену. Здесь его получить
        // $user = $request->attributes->('authUser');
        $data = $request->validated();
    }
}
