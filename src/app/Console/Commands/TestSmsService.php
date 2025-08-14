<?php

namespace App\Console\Commands;

use App\Services\SmsCodeService;
use Illuminate\Console\Command;

class TestSmsService extends Command
{
    protected $signature = 'sms:test {phone}';
    protected $description = 'Test SMS service with a phone number';

    public function handle(SmsCodeService $smsService): int
    {
        $phone = $this->argument('phone');
        
        $this->info("Testing SMS service for phone: {$phone}");
        
        // Проверяем баланс
        $this->info('Checking balance...');
        $balance = $smsService->getBalance();
        
        if ($balance['success']) {
            $this->info("Balance: {$balance['balance']} credits");
        } else {
            $this->error("Failed to get balance: {$balance['message']}");
            return 1;
        }
        
        // Отправляем тестовое SMS
        $this->info('Sending test SMS...');
        $result = $smsService->sendSmsCode($phone, 'Тестовое сообщение от Laravel');
        
        if ($result['success']) {
            $this->info("SMS sent successfully! SMS ID: {$result['sms_id']}");
            
            // Проверяем статус SMS
            if ($result['sms_id']) {
                $this->info('Checking SMS status...');
                $status = $smsService->getSmsStatus($result['sms_id']);
                
                if ($status['success']) {
                    $this->info("SMS Status: {$status['status']} - {$status['status_text']}");
                } else {
                    $this->warn("Failed to get SMS status: {$status['message']}");
                }
            }
        } else {
            $this->error("Failed to send SMS: {$result['message']}");
            return 1;
        }
        
        $this->info('Test completed successfully!');
        return 0;
    }
}
