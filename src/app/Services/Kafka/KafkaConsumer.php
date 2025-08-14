<?php

namespace App\Services\Kafka;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Illuminate\Support\Facades\Log;
use App\Services\Logging\ClickHouseLogger;

class KafkaConsumer
{
    public function __construct(
        private ClickHouseLogger $clickHouseLogger
    ) {}

    /**
     * Запуск консюмера для обработки событий дизайнов
     */
    public function consumeDesigns(): void
    {
        $consumer = Kafka::createConsumer()
            ->subscribe('designs')
            ->withHandler(function (KafkaConsumerMessage $message) {
                $this->handleDesignEvent($message);
            })
            ->withConsumerGroupId('main-service-designs')
            ->build();

        $consumer->consume();
    }

    /**
     * Запуск консюмера для обработки заказов
     */
    public function consumeOrders(): void
    {
        $consumer = Kafka::createConsumer()
            ->subscribe('orders')
            ->withHandler(function (KafkaConsumerMessage $message) {
                $this->handleOrderEvent($message);
            })
            ->withConsumerGroupId('main-service-orders')
            ->build();

        $consumer->consume();
    }

    /**
     * Обработка событий дизайнов
     */
    private function handleDesignEvent(KafkaConsumerMessage $message): void
    {
        $startTime = microtime(true);
        
        try {
            $body = $message->getBody();
            $eventType = $body['event_type'] ?? 'unknown';
            $designId = $body['design_id'] ?? null;
            $userId = $body['user_id'] ?? null;

            Log::info("Processing design event: {$eventType}", [
                'design_id' => $designId,
                'user_id' => $userId,
                'body' => $body
            ]);

            // Логируем в ClickHouse
            $this->clickHouseLogger->logKafka(
                'designs',
                'consume',
                'success',
                "Design event processed: {$eventType}",
                $designId,
                $message->getPartition(),
                $message->getOffset(),
                null,
                microtime(true) - $startTime
            );

            // Обрабатываем разные типы событий
            switch ($eventType) {
                case 'design.created':
                    $this->handleDesignCreated($body);
                    break;
                case 'design.updated':
                    $this->handleDesignUpdated($body);
                    break;
                case 'design.deleted':
                    $this->handleDesignDeleted($body);
                    break;
                case 'design.status_changed':
                    $this->handleDesignStatusChanged($body);
                    break;
                default:
                    Log::warning("Unknown design event type: {$eventType}");
            }

        } catch (\Exception $e) {
            Log::error('Failed to process design event', [
                'error' => $e->getMessage(),
                'body' => $message->getBody()
            ]);

            // Логируем ошибку в ClickHouse
            $this->clickHouseLogger->logKafka(
                'designs',
                'consume',
                'error',
                'Failed to process design event',
                $body['design_id'] ?? null,
                $message->getPartition(),
                $message->getOffset(),
                $e->getMessage(),
                microtime(true) - $startTime
            );
        }
    }

    /**
     * Обработка событий заказов
     */
    private function handleOrderEvent(KafkaConsumerMessage $message): void
    {
        $startTime = microtime(true);
        
        try {
            $body = $message->getBody();
            $eventType = $body['event_type'] ?? 'unknown';
            $orderId = $body['order_id'] ?? null;

            Log::info("Processing order event: {$eventType}", [
                'order_id' => $orderId,
                'body' => $body
            ]);

            // Логируем в ClickHouse
            $this->clickHouseLogger->logKafka(
                'orders',
                'consume',
                'success',
                "Order event processed: {$eventType}",
                $orderId,
                $message->getPartition(),
                $message->getOffset(),
                null,
                microtime(true) - $startTime
            );

            // Обрабатываем заказ
            if ($eventType === 'order.created') {
                $this->handleOrderCreated($body);
            }

        } catch (\Exception $e) {
            Log::error('Failed to process order event', [
                'error' => $e->getMessage(),
                'body' => $message->getBody()
            ]);

            // Логируем ошибку в ClickHouse
            $this->clickHouseLogger->logKafka(
                'orders',
                'consume',
                'error',
                'Failed to process order event',
                $body['order_id'] ?? null,
                $message->getPartition(),
                $message->getOffset(),
                $e->getMessage(),
                microtime(true) - $startTime
            );
        }
    }

    /**
     * Обработка создания дизайна
     */
    private function handleDesignCreated(array $data): void
    {
        // Здесь логика обработки создания дизайна
        // Например: уведомление администраторов, создание задач и т.д.
        Log::info('Design created', $data);
    }

    /**
     * Обработка обновления дизайна
     */
    private function handleDesignUpdated(array $data): void
    {
        // Логика обработки обновления дизайна
        Log::info('Design updated', $data);
    }

    /**
     * Обработка удаления дизайна
     */
    private function handleDesignDeleted(array $data): void
    {
        // Логика обработки удаления дизайна
        Log::info('Design deleted', $data);
    }

    /**
     * Обработка изменения статуса дизайна
     */
    private function handleDesignStatusChanged(array $data): void
    {
        // Логика обработки изменения статуса
        Log::info('Design status changed', $data);
    }

    /**
     * Обработка создания заказа
     */
    private function handleOrderCreated(array $data): void
    {
        // Логика обработки создания заказа
        Log::info('Order created', $data);
    }
}
