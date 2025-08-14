<?php

namespace App\Console\Commands;

use App\Services\Kafka\KafkaConsumer;
use Illuminate\Console\Command;

class KafkaConsumeOrders extends Command
{
    protected $signature = 'kafka:consume-orders';
    protected $description = 'Start Kafka consumer for order events';

    public function handle(KafkaConsumer $kafkaConsumer): int
    {
        $this->info('Starting Kafka consumer for order events...');
        $this->info('Press Ctrl+C to stop');

        try {
            $kafkaConsumer->consumeOrders();
        } catch (\Exception $e) {
            $this->error("Consumer failed: {$e->getMessage()}");
            return 1;
        }

        return 0;
    }
}
