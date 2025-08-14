<?php

namespace App\Services\Logging;

use ClickHouseDB\Client;
use ClickHouse\Common\Format;
use Illuminate\Support\Facades\Log;

class ClickHouseLogger
{
    private string $database;

    public function __construct(private Client $client)
    {
    }

    /**
     * Логирование в ClickHouse
     */
    private function logToClickHouse(string $table, array $data): bool
    {
        try {
            $this->client->insert($table, [$data]);
            return true;
            
        } catch (\Exception $e) {
            Log::error('ClickHouse insert failed', [
                'table' => $table,
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            return false;
        }
    }

    /**
     * Логирование SMS операций
     */
    public function logSms(string $phone, string $action, string $status, string $message, ?string $smsId = null, ?string $apiResponse = null, ?string $errorMessage = null, ?float $executionTime = null): void
    {
        $logData = [
            'phone' => $phone,
            'action' => $action,
            'status' => $status,
            'message' => $message,
            'sms_id' => $smsId,
            'api_response' => $apiResponse ?? '',
            'error_message' => $errorMessage,
            'execution_time_ms' => $executionTime,
        ];

        $this->logToClickHouse('sms_logs', $logData);
    }

    /**
     * Логирование Kafka операций
     */
    public function logKafka(string $topic, string $action, string $status, string $message, ?string $key = null, ?int $partition = null, ?int $offset = null, ?string $errorMessage = null, ?float $executionTime = null): void
    {
        $logData = [
            'topic' => $topic,
            'action' => $action,
            'status' => $status,
            'message' => $message,
            'key' => $key,
            'partition' => $partition,
            'offset' => $offset,
            'error_message' => $errorMessage,
            'execution_time_ms' => $executionTime,
        ];

        $this->logToClickHouse('kafka_logs', $logData);
    }

    /**
     * Логирование HTTP запросов
     */
    public function logHttpRequest(string $method, string $url, int $statusCode, float $responseTime, ?string $userId = null, string $ipAddress = '', ?string $userAgent = null, ?int $requestSize = null, ?int $responseSize = null): void
    {
        $logData = [
            'method' => $method,
            'url' => $url,
            'status_code' => $statusCode,
            'response_time_ms' => $responseTime,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'request_size_bytes' => $requestSize,
            'response_size_bytes' => $responseSize,
        ];

        $this->logToClickHouse('http_requests', $logData);
    }

    /**
     * Логирование общих событий приложения
     */
    public function logApplication(string $level, string $message, string $context = '', ?string $userId = null, ?string $ipAddress = null, ?string $userAgent = null, ?string $requestId = null, ?string $method = null, ?string $url = null, ?float $executionTime = null, ?float $memoryUsage = null): void
    {
        $logData = [
            'level' => $level,
            'message' => $message,
            'context' => $context,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'request_id' => $requestId,
            'method' => $method,
            'url' => $url,
            'execution_time_ms' => $executionTime,
            'memory_usage_mb' => $memoryUsage,
        ];

        $this->logToClickHouse('application_logs', $logData);
    }

    /**
     * Выполнение произвольного SQL запроса
     */
    public function executeQuery(string $query): array
    {
        try {
            $result = $this->client->select($query);
            return $result->rows();
            
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Получение статистики по логам
     */
    public function getLogStats(string $table, string $timeRange = '1 day'): array
    {
        $query = "
            SELECT 
                count() as total_count,
                countIf(status = 'success') as success_count,
                countIf(status = 'error') as error_count,
                avg(execution_time_ms) as avg_execution_time
            FROM {$this->database}.{$table}
            WHERE timestamp >= now() - INTERVAL {$timeRange}
        ";

        try {
            $result = $this->client->select($query);
            return ['data' => $result->rows()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Проверка подключения к ClickHouse
     */
    public function testConnection(): bool
    {
        try {
            $this->client->select('SELECT 1 as test');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Получение информации о таблицах
     */
    public function getTablesInfo(): array
    {
        try {
            $query = "SHOW TABLES FROM {$this->database}";
            $result = $this->client->select($query);
            return $result->rows();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Получение размера таблиц
     */
    public function getTablesSize(): array
    {
        try {
            $query = "
                SELECT 
                    table,
                    formatReadableSize(sum(bytes)) as size,
                    count() as parts
                FROM system.parts 
                WHERE database = '{$this->database}' 
                GROUP BY table
            ";
            $result = $this->client->select($query);
            return $result->rows();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
