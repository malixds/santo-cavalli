<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Services\Logging\ClickHouseLogger;

class SmsCodeService
{
    private string $apiKey;
    private string $baseUrl = 'https://sms.ru';
    private int $cacheTtl = 300;

    public function __construct(
        private ClickHouseLogger $clickHouseLogger
    ) {
        $this->apiKey = config('services.smsru.api_key', '');
    }

    /**
     * Отправка SMS с кодом подтверждения
     */
    public function sendSmsCode(string $phone, ?string $message = null): array
    {
        $startTime = microtime(true);
        
        try {
            $code = $this->generateCode();           
            $smsText = $message ?? "Ваш код подтверждения: {$code}";
            
            $response = $this->sendSms($phone, $smsText);
            
            if ($response['success']) {
                // Сохраняем код в кэш для проверки
                $this->cacheCode($phone, $code);
                
                // Логируем в ClickHouse
                $this->clickHouseLogger->logSms(
                    $phone,
                    'send',
                    'success',
                    'SMS code sent successfully',
                    $response['sms_id'] ?? null,
                    json_encode($response),
                    null,
                    microtime(true) - $startTime
                );
                
                Log::info('SMS code sent successfully', [
                    'phone' => $phone,
                    'code' => $code,
                    'sms_id' => $response['sms_id'] ?? null
                ]);
                
                return [
                    'success' => true,
                    'message' => 'Код подтверждения отправлен',
                    'sms_id' => $response['sms_id'] ?? null
                ];
            }
            
            return $response;
            
        } catch (\Exception $e) {
            // Логируем ошибку в ClickHouse
            $this->clickHouseLogger->logSms(
                $phone,
                'send',
                'error',
                'Failed to send SMS code',
                null,
                null,
                $e->getMessage(),
                microtime(true) - $startTime
            );
            
            Log::error('Failed to send SMS code', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => 'Ошибка отправки SMS',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Проверка кода подтверждения
     */
    public function verifyCode(string $phone, string $code): bool
    {
        $cachedCode = Cache::get("sms_code_{$phone}");
        
        if ($cachedCode && $cachedCode === $code) {
            // Удаляем код после успешной проверки
            Cache::forget("sms_code_{$phone}");
            return true;
        }
        
        return false;
    }

    /**
     * Отправка SMS через SMS.ru API
     */
    private function sendSms(string $phone, string $message): array
    {
        $response = Http::get($this->baseUrl . '/sms/send', [
            'api_id' => $this->apiKey,
            'to' => $phone,
            'msg' => $message,
            'json' => 1
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['status']) && $data['status'] === 'OK') {
                return [
                    'success' => true,
                    'sms_id' => $data['sms'][$phone]['sms_id'] ?? null
                ];
            }
            
            return [
                'success' => false,
                'message' => $data['status_text'] ?? 'Неизвестная ошибка'
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Ошибка HTTP запроса'
        ];
    }

    /**
     * Проверка баланса
     */
    public function getBalance(): array
    {
        try {
            $response = Http::get($this->baseUrl . '/my/balance', [
                'api_id' => $this->apiKey,
                'json' => 1
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === 'OK') {
                    return [
                        'success' => true,
                        'balance' => $data['balance'] ?? 0
                    ];
                }
            }
            
            return [
                'success' => false,
                'message' => 'Не удалось получить баланс'
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка получения баланса',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Проверка статуса SMS
     */
    public function getSmsStatus(string $smsId): array
    {
        try {
            $response = Http::get($this->baseUrl . '/sms/status', [
                'api_id' => $this->apiKey,
                'sms_id' => $smsId,
                'json' => 1
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === 'OK') {
                    return [
                        'success' => true,
                        'status' => $data['sms'][$smsId]['status'] ?? 'unknown',
                        'status_text' => $data['sms'][$smsId]['status_text'] ?? 'Неизвестный статус'
                    ];
                }
            }
            
            return [
                'success' => false,
                'message' => 'Не удалось получить статус SMS'
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка получения статуса SMS',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Генерация кода подтверждения
     */
    private function generateCode(int $length = 4): string
    {
        return str_pad((string) random_int(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }

    /**
     * Сохранение кода в кэш
     */
    private function cacheCode(string $phone, string $code): void
    {
        Cache::put("sms_code_{$phone}", $code, $this->cacheTtl);
    }
}
