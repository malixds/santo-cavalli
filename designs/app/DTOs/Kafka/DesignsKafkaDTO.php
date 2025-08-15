<?php


namespace App\DTOs\Kafka;

use Carbon\Carbon;

class DesignsKafkaDTO
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
        public readonly string $eventType = 'design.created',
        public readonly string $sourceService = 'designs',
        public readonly ?Carbon $timestamp = null,
        public readonly ?string $eventId = null
    ) {
        $this->timestamp ??= Carbon::now();
        $this->eventId ??= uniqid('event_');
    }

    public function toArray(): array
    {
        $data = [
            'design_id' => $this->designId,
            'user_id' => $this->userId,
            'event_type' => $this->eventType,
            'source_service' => $this->sourceService,
            'timestamp' => $this->timestamp->toISOString(),
            'event_id' => $this->eventId,
        ];

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

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    // Factory методы
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
