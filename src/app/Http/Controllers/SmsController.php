<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetSmsCodeRequest;
use App\Http\Requests\VerifySmsCodeRequest;
use App\Services\SmsCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function __construct(
        private SmsCodeService $smsService
    ) {}

    /**
     * Отправка SMS с кодом подтверждения
     */
    public function sendCode(GetSmsCodeRequest $request): JsonResponse
    {
        $phone = $request->validated('phone');
        
        $result = $this->smsService->sendSmsCode($phone);
        
        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => [
                    'phone' => $phone,
                    'sms_id' => $result['sms_id'] ?? null
                ]
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 400);
    }

    /**
     * Проверка SMS кода
     */
    public function verifyCode(VerifySmsCodeRequest $request): JsonResponse
    {
        $phone = $request->validated('phone');
        $code = $request->validated('code');
        
        $isValid = $this->smsService->verifyCode($phone, $code);
        
        if ($isValid) {
            return response()->json([
                'success' => true,
                'message' => 'Код подтверждения верен'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Неверный код подтверждения'
        ], 400);
    }

    /**
     * Проверка баланса SMS.ru
     */
    public function getBalance(): JsonResponse
    {
        $result = $this->smsService->getBalance();
        
        if ($result['success']) {
            return response()->json([
                'success' => true,
                'balance' => $result['balance']
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 400);
    }

    /**
     * Проверка статуса SMS
     */
    public function getSmsStatus(Request $request): JsonResponse
    {
        $request->validate([
            'sms_id' => 'required|string'
        ]);
        
        $result = $this->smsService->getSmsStatus($request->sms_id);
        
        if ($result['success']) {
            return response()->json([
                'success' => true,
                'status' => $result['status'],
                'status_text' => $result['status_text']
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 400);
    }
}
