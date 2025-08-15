<?php

namespace App\Services\Kafka;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use App\DTOs\Kafka\OrderEventDTO;
use App\DTOs\Kafka\DesignEventDTO;
use App\DTOs\Kafka\NotificationEventDTO;

class KafkaProducer 
{
    /**
     * Отправка события создания заказа
     */
    public function sendOrderCreated(array $data): void
    {
        $dto = OrderEventDTO::createOrderCreated(
            orderId: $data['id'],
            amount: $data['amount'],
            userId: $data['user_id'] ?? null
        );

        $message = new Message(
            'orders',
            $dto->toArray(),
            $dto->orderId
        );

        Kafka::publish($message);
    }

    /**
     * Отправка события создания дизайна (от designs сервиса)
     */
    public function sendDesignCreated(array $data): void
    {
        $dto = DesignEventDTO::createDesignCreated(
            designId: $data['id'],
            userId: $data['user_id'],
            title: $data['title'],
            description: $data['description'] ?? null,
            status: $data['status'] ?? 'pending'
        );

        $message = new Message(
            'designs',
            $dto->toArray(),
            $dto->designId
        );

        Kafka::publish($message);
    }

    /**
     * Отправка события обновления дизайна
     */
    public function sendDesignUpdated(array $data): void
    {
        $dto = DesignEventDTO::createDesignUpdated(
            designId: $data['id'],
            userId: $data['user_id'],
            title: $data['title'] ?? null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? null
        );

        $message = new Message(
            'designs',
            $dto->toArray(),
            $dto->designId
        );

        Kafka::publish($message);
    }

    /**
     * Отправка события удаления дизайна
     */
    public function sendDesignDeleted(array $data): void
    {
        $dto = DesignEventDTO::createDesignDeleted(
            designId: $data['id'],
            userId: $data['user_id']
        );

        $message = new Message(
            'designs',
            $dto->toArray(),
            $dto->designId
        );

        Kafka::publish($message);
    }

    /**
     * Отправка события изменения статуса дизайна
     */
    public function sendDesignStatusChanged(array $data): void
    {
        $dto = DesignEventDTO::createDesignStatusChanged(
            designId: $data['id'],
            userId: $data['user_id'],
            oldStatus: $data['old_status'],
            newStatus: $data['new_status'],
            reason: $data['reason'] ?? null
        );

        $message = new Message(
            'designs',
            $dto->toArray(),
            $dto->designId
        );

        Kafka::publish($message);
    }

    /**
     * Отправка произвольного события
     */
    public function sendEvent(string $topic, array $data, ?string $key = null): void
    {
        $dto = NotificationEventDTO::createNotification(
            type: $data['type'] ?? 'custom',
            message: $data['message'] ?? 'Custom event',
            userId: $data['user_id'] ?? null,
            metadata: $data
        );

        $message = new Message(
            $topic,
            $dto->toArray(),
            $key
        );

        Kafka::publish($message);
    }
}

