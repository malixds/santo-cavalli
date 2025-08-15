<?php

namespace App\DTOs\Kafka;

use Carbon\Carbon;

class OrderEventDTO extends BaseEventDTO
{
    public function __construct(
        public readonly string $orderId,
        public readonly float $amount,
        public readonly ?string $userId,
        public readonly Carbon $createdAt,
        string $eventType = 'order.created',
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
        return array_merge(parent::toArray(), [
            'order_id' => $this->orderId,
            'amount' => $this->amount,
            'user_id' => $this->userId,
            'created_at' => $this->createdAt->toISOString(),
        ]);
    }

    public static function fromArray(array $data): static
    {
        return new static(
            orderId: $data['order_id'],
            amount: (float) $data['amount'],
            userId: $data['user_id'] ?? null,
            createdAt: Carbon::parse($data['created_at']),
            eventType: $data['event_type'] ?? 'order.created',
            sourceService: $data['source_service'] ?? 'main',
            timestamp: isset($data['timestamp']) ? Carbon::parse($data['timestamp']) : null,
            eventId: $data['event_id'] ?? null
        );
    }

    public static function createOrderCreated(
        string $orderId,
        float $amount,
        ?string $userId = null
    ): static {
        return new static(
            orderId: $orderId,
            amount: $amount,
            userId: $userId,
            createdAt: Carbon::now()
        );
    }
}
