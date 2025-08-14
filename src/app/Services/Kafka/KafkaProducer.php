<?php

namespace App\Services\Kafka;

use Junges\Kafka\Facades\Kafka;

class KafkaProducer {
    public function sendOrderCreated(array $data): void
    {
        Kafka::publishOn('orders')
            ->withBodyKey('order_id', $data['id'])
            ->withBodyKey('amount', $data['amount'])
            ->send();
    }
}

