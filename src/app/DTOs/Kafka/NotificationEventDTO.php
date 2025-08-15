<?php

namespace App\DTOs\Kafka;

use Carbon\Carbon;

class NotificationEventDTO extends BaseEventDTO
{
    public function __construct(
        public readonly string $type,
        public readonly string $message,
        public readonly ?string $userId = null,
        public readonly ?array $metadata = null,
        public readonly ?string $priority = 'normal',
        string $eventType = 'notification.sent',
        string $sourceService = 'main',
        ?Carbon $timestamp = null,
        ?string $eventId = null
    ) {
        parent::__construct(
            eventType: $eventType,
            sourceService: $sourceService,
            timestamp: $timestamp ?? Carbon::now(),
            eventId: $eventId
        );
    }

    public function toArray(): array
    {
        $data = array_merge(parent::toArray(), [
            'type' => $this->type,
            'message' => $this->message,
            'priority' => $this->priority,
        ]);

        if ($this->userId !== null) {
            $data['user_id'] = $this->userId;
        }
        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        return $data;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            type: $data['type'],
            message: $data['message'],
            userId: $data['user_id'] ?? null,
            metadata: $data['metadata'] ?? null,
            priority: $data['priority'] ?? 'normal',
            eventType: $data['event_type'] ?? 'notification.sent',
            sourceService: $data['source_service'] ?? 'main',
            timestamp: isset($data['timestamp']) ? Carbon::parse($data['timestamp']) : null,
            eventId: $data['event_id'] ?? null
        );
    }

    public static function createNotification(
        string $type,
        string $message,
        ?string $userId = null,
        ?array $metadata = null,
        string $priority = 'normal'
    ): static {
        return new static(
            type: $type,
            message: $message,
            userId: $userId,
            metadata: $metadata,
            priority: $priority
        );
    }
}
