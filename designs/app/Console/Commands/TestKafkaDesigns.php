<?php

namespace App\Console\Commands;

use App\Services\Kafka\DesignsKafkaProducer;
use Illuminate\Console\Command;

class TestKafkaDesigns extends Command
{
    protected $signature = 'kafka:test-designs';
    protected $description = 'Test Kafka producer for designs service';

    public function handle(DesignsKafkaProducer $kafkaProducer): int
    {
        $this->info('Testing Kafka producer for designs service...');

        try {
            // Тестируем создание дизайна
            $this->info('Testing design created event...');
            $kafkaProducer->sendDesignCreated([
                'id' => 'test_design_' . uniqid(),
                'user_id' => 'test_user_123',
                'title' => 'Тестовый дизайн',
                'description' => 'Описание тестового дизайна',
                'status' => 'pending'
            ]);

            // Тестируем обновление дизайна
            $this->info('Testing design updated event...');
            $kafkaProducer->sendDesignUpdated([
                'id' => 'test_design_' . uniqid(),
                'user_id' => 'test_user_123',
                'title' => 'Обновленный дизайн',
                'description' => 'Обновленное описание',
                'status' => 'approved'
            ]);

            // Тестируем изменение статуса
            $this->info('Testing design status changed event...');
            $kafkaProducer->sendDesignStatusChanged([
                'id' => 'test_design_' . uniqid(),
                'user_id' => 'test_user_123',
                'old_status' => 'pending',
                'new_status' => 'approved',
                'reason' => 'Дизайн одобрен администратором'
            ]);

            // Тестируем удаление дизайна
            $this->info('Testing design deleted event...');
            $kafkaProducer->sendDesignDeleted([
                'id' => 'test_design_' . uniqid(),
                'user_id' => 'test_user_123'
            ]);

            $this->info('✅ All Kafka events sent successfully!');
            return 0;

        } catch (\Exception $e) {
            $this->error("Failed to send Kafka events: {$e->getMessage()}");
            return 1;
        }
    }
}
