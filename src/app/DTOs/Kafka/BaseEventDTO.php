<?php

namespace App\DTOs\Kafka;

use Carbon\Carbon;

abstract class BaseEventDTO
{
    public function __construct(
        public readonly string $eventType,
        public readonly string $sourceService,
        public readonly Carbon $timestamp,
        public readonly ?string $eventId = null
    ) {
        $this->eventId ??= uniqid('event_');
    }

    public function toArray(): array
    {
        return [
            'event_id' => $this->eventId,
            'event_type' => $this->eventType,
            'source_service' => $this->sourceService,
            'timestamp' => $this->timestamp->toISOString(),
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public static function fromArray(array $data): static
    {
        return new static(
            eventType: $data['event_type'],
            sourceService: $data['source_service'],
            timestamp: Carbon::parse($data['timestamp']),
            eventId: $data['event_id'] ?? null
        );
    }
}
