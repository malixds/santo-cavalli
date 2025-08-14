<?php

namespace App\Console\Commands;

use App\Services\Kafka\KafkaProducer;
use Illuminate\Console\Command;

class TestKafkaIntegration extends Command
{
    protected $signature = 'kafka:test-integration';
    protected $description = 'Test Kafka integration between services';

    public function handle(KafkaProducer $kafkaProducer): int
    {
        $this->info('Testing Kafka integration between services...');

        try {
            // Тестируем отправку события создания заказа
            $this->info('Testing order created event...');
            $kafkaProducer->sendOrderCreated([
                'id' => 'order_' . uniqid(),
                'amount' => 1500.00,
                'user_id' => 'user_' . uniqid()
            ]);

            // Тестируем отправку события создания дизайна
            $this->info('Testing design created event...');
            $kafkaProducer->sendDesignCreated([
                'id' => 'design_' . uniqid(),
                'user_id' => 'user_' . uniqid(),
                'title' => 'Тестовый дизайн',
                'description' => 'Описание тестового дизайна',
                'status' => 'pending'
            ]);

            // Тестируем отправку произвольного события
            $this->info('Testing custom event...');
            $kafkaProducer->sendEvent('notifications', [
                'type' => 'test',
                'message' => 'Тестовое уведомление',
                'user_id' => 'user_' . uniqid()
            ], 'notification_key');

            $this->info('✅ All Kafka events sent successfully!');
            $this->info('Check your Kafka consumers to see if they received the events.');
            
            return 0;

        } catch (\Exception $e) {
            $this->error("Failed to send Kafka events: {$e->getMessage()}");
            return 1;
        }
    }
}
