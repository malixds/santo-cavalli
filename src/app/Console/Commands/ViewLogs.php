<?php

namespace App\Console\Commands;

use App\Services\Logging\ClickHouseLogger;
use Illuminate\Console\Command;

class ViewLogs extends Command
{
    protected $signature = 'logs:view 
                            {table : Table name (sms_logs, kafka_logs, http_requests, application_logs)}
                            {--limit=10 : Number of records to show}
                            {--status= : Filter by status (success, error)}
                            {--level= : Filter by level (for application_logs)}
                            {--phone= : Filter by phone (for sms_logs)}
                            {--topic= : Filter by topic (for kafka_logs)}
                            {--method= : Filter by HTTP method (for http_requests)}';

    protected $description = 'View logs from ClickHouse with filtering options';

    public function handle(ClickHouseLogger $clickHouseLogger): int
    {
        $table = $this->argument('table');
        $limit = $this->option('limit');
        $status = $this->option('status');
        $level = $this->option('level');
        $phone = $this->option('phone');
        $topic = $this->option('topic');
        $method = $this->option('method');

        // Проверяем подключение
        if (!$clickHouseLogger->testConnection()) {
            $this->error('Failed to connect to ClickHouse');
            return 1;
        }

        // Строим WHERE условия
        $whereConditions = [];
        if ($status) {
            $whereConditions[] = "status = '{$status}'";
        }
        if ($level && $table === 'application_logs') {
            $whereConditions[] = "level = '{$level}'";
        }
        if ($phone && $table === 'sms_logs') {
            $whereConditions[] = "phone = '{$phone}'";
        }
        if ($topic && $table === 'kafka_logs') {
            $whereConditions[] = "topic = '{$topic}'";
        }
        if ($method && $table === 'http_requests') {
            $whereConditions[] = "method = '{$method}'";
        }

        $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

        // Формируем запрос
        $query = "
            SELECT *
            FROM logs.{$table}
            {$whereClause}
            ORDER BY timestamp DESC
            LIMIT {$limit}
        ";

        $this->info("Query: {$query}");
        $this->newLine();

        try {
            $result = $clickHouseLogger->executeQuery($query);
            
            if (empty($result)) {
                $this->info('No logs found');
                return 0;
            }

            // Определяем заголовки на основе первой записи
            $headers = array_keys($result[0]);
            
            // Форматируем данные для таблицы
            $rows = [];
            foreach ($result as $row) {
                $formattedRow = [];
                foreach ($headers as $header) {
                    $value = $row[$header];
                    
                    // Форматируем timestamp
                    if ($header === 'timestamp' && $value) {
                        $value = date('Y-m-d H:i:s', strtotime($value));
                    }
                    
                    // Обрезаем длинные значения
                    if (is_string($value) && strlen($value) > 50) {
                        $value = substr($value, 0, 47) . '...';
                    }
                    
                    $formattedRow[] = $value;
                }
                $rows[] = $formattedRow;
            }

            $this->table($headers, $rows);
            
            $this->info("Total records: " . count($result));
            
        } catch (\Exception $e) {
            $this->error("Failed to execute query: {$e->getMessage()}");
            return 1;
        }

        return 0;
    }
}
