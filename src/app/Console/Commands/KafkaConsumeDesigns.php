<?php

namespace App\Console\Commands;

use App\Services\Kafka\KafkaConsumer;
use Illuminate\Console\Command;

class KafkaConsumeDesigns extends Command
{
    protected $signature = 'kafka:consume-designs';
    protected $description = 'Start Kafka consumer for design events';

    public function handle(KafkaConsumer $kafkaConsumer): int
    {
        $this->info('Starting Kafka consumer for design events...');
        $this->info('Press Ctrl+C to stop');

        try {
            $kafkaConsumer->consumeDesigns();
        } catch (\Exception $e) {
            $this->error("Consumer failed: {$e->getMessage()}");
            return 1;
        }

        return 0;
    }
}
