<?php

namespace App\Services\Kafka;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class DesignsKafkaProducer
{
    /**
     * Отправка события создания дизайна
     */
    public function sendDesignCreated(array $data): void
    {
        $message = new Message(
            'designs',
            [
                'design_id' => $data['id'],
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? 'pending',
                'created_at' => now()->toISOString(),
                'event_type' => 'design.created',
                'source_service' => 'designs'
            ],
            $data['id'] ?? null
        );

        Kafka::publish($message);
    }

    /**
     * Отправка события обновления дизайна
     */
    public function sendDesignUpdated(array $data): void
    {
        $message = new Message(
            'designs',
            [
                'design_id' => $data['id'],
                'user_id' => $data['user_id'],
                'title' => $data['title'] ?? null,
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? null,
                'updated_at' => now()->toISOString(),
                'event_type' => 'design.updated',
                'source_service' => 'designs'
            ],
            $data['id'] ?? null
        );

        Kafka::publish($message);
    }

    /**
     * Отправка события удаления дизайна
     */
    public function sendDesignDeleted(array $data): void
    {
        $message = new Message(
            'designs',
            [
                'design_id' => $data['id'],
                'user_id' => $data['user_id'],
                'deleted_at' => now()->toISOString(),
                'event_type' => 'design.deleted',
                'source_service' => 'designs'
            ],
            $data['id'] ?? null
        );

        Kafka::publish($message);
    }

    /**
     * Отправка события изменения статуса дизайна
     */
    public function sendDesignStatusChanged(array $data): void
    {
        $message = new Message(
            'designs',
            [
                'design_id' => $data['id'],
                'user_id' => $data['user_id'],
                'old_status' => $data['old_status'],
                'new_status' => $data['new_status'],
                'changed_at' => now()->toISOString(),
                'event_type' => 'design.status_changed',
                'source_service' => 'designs',
                'reason' => $data['reason'] ?? null
            ],
            $data['id'] ?? null
        );

        Kafka::publish($message);
    }

    /**
     * Отправка произвольного события
     */
    public function sendEvent(string $topic, array $data, ?string $key = null): void
    {
        $message = new Message(
            $topic,
            array_merge($data, [
                'timestamp' => now()->toISOString(),
                'source_service' => 'designs'
            ]),
            $key
        );

        Kafka::publish($message);
    }
}
