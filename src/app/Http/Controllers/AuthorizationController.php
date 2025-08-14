<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\GetSmsCodeRequest;
use App\Http\Requests\SendSmsCodeRequest;
use App\Services\SmsCodeService;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function __construct(private SmsCodeService $smsCodeService) {

    }
    
    public function getSmsCode(GetSmsCodeRequest $request)
    {
        $phone = $request->validated()['phone'];
        $this->smsCodeService->sendSmsCode($phone);

    }

    public function sendCode(SendSmsCodeRequest $request)
    {
        $data = $request->validated();
    }
}
