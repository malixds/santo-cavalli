<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\GetSmsCodeRequest;
use App\Http\Requests\SendSmsCodeRequest;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function getSmsCode(GetSmsCodeRequest $request)
    {
        $phone = $request->phone;
    }

    public function sendCode(SendSmsCodeRequest $request)
    {
        $data = $request->validated();
    }
}
