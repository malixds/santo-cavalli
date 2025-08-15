<?php

namespace App\DTOs\Kafka;

use Carbon\Carbon;

class DesignEventDTO extends BaseEventDTO
{
    public function __construct(
        public readonly string $designId,
        public readonly string $userId,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?string $status = null,
        public readonly ?Carbon $createdAt = null,
        public readonly ?Carbon $updatedAt = null,
        public readonly ?Carbon $deletedAt = null,
        public readonly ?string $oldStatus = null,
        public readonly ?string $newStatus = null,
        public readonly ?string $reason = null,
        string $eventType = 'design.created',
        string $sourceService = 'designs',
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
            'design_id' => $this->designId,
            'user_id' => $this->userId,
        ]);

        // Добавляем поля в зависимости от типа события
        if ($this->title !== null) {
            $data['title'] = $this->title;
        }
        if ($this->description !== null) {
            $data['description'] = $this->description;
        }
        if ($this->status !== null) {
            $data['status'] = $this->status;
        }
        if ($this->createdAt !== null) {
            $data['created_at'] = $this->createdAt->toISOString();
        }
        if ($this->updatedAt !== null) {
            $data['updated_at'] = $this->updatedAt->toISOString();
        }
        if ($this->deletedAt !== null) {
            $data['deleted_at'] = $this->deletedAt->toISOString();
        }
        if ($this->oldStatus !== null) {
            $data['old_status'] = $this->oldStatus;
        }
        if ($this->newStatus !== null) {
            $data['new_status'] = $this->newStatus;
        }
        if ($this->reason !== null) {
            $data['reason'] = $this->reason;
        }

        return $data;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            designId: $data['design_id'],
            userId: $data['user_id'],
            title: $data['title'] ?? null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? null,
            createdAt: isset($data['created_at']) ? Carbon::parse($data['created_at']) : null,
            updatedAt: isset($data['updated_at']) ? Carbon::parse($data['updated_at']) : null,
            deletedAt: isset($data['deleted_at']) ? Carbon::parse($data['deleted_at']) : null,
            oldStatus: $data['old_status'] ?? null,
            newStatus: $data['new_status'] ?? null,
            reason: $data['reason'] ?? null,
            eventType: $data['event_type'] ?? 'design.created',
            sourceService: $data['source_service'] ?? 'designs',
            timestamp: isset($data['timestamp']) ? Carbon::parse($data['timestamp']) : null,
            eventId: $data['event_id'] ?? null
        );
    }

    // Factory методы для разных типов событий
    public static function createDesignCreated(
        string $designId,
        string $userId,
        string $title,
        ?string $description = null,
        string $status = 'pending'
    ): static {
        return new static(
            designId: $designId,
            userId: $userId,
            title: $title,
            description: $description,
            status: $status,
            createdAt: Carbon::now(),
            eventType: 'design.created'
        );
    }

    public static function createDesignUpdated(
        string $designId,
        string $userId,
        ?string $title = null,
        ?string $description = null,
        ?string $status = null
    ): static {
        return new static(
            designId: $designId,
            userId: $userId,
            title: $title,
            description: $description,
            status: $status,
            updatedAt: Carbon::now(),
            eventType: 'design.updated'
        );
    }

    public static function createDesignDeleted(
        string $designId,
        string $userId
    ): static {
        return new static(
            designId: $designId,
            userId: $userId,
            deletedAt: Carbon::now(),
            eventType: 'design.deleted'
        );
    }

    public static function createDesignStatusChanged(
        string $designId,
        string $userId,
        string $oldStatus,
        string $newStatus,
        ?string $reason = null
    ): static {
        return new static(
            designId: $designId,
            userId: $userId,
            oldStatus: $oldStatus,
            newStatus: $newStatus,
            reason: $reason,
            updatedAt: Carbon::now(),
            eventType: 'design.status_changed'
        );
    }
}
