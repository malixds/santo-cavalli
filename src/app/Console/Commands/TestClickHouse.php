<?php

namespace App\Console\Commands;

use App\Services\Logging\ClickHouseLogger;
use Illuminate\Console\Command;

class TestClickHouse extends Command
{
    protected $signature = 'clickhouse:test';
    protected $description = 'Test ClickHouse connection and logging';

    public function handle(ClickHouseLogger $clickHouseLogger): int
    {
        $this->info('Testing ClickHouse connection...');

        try {
            // Тестируем подключение
            $this->info('Testing connection...');
            if (!$clickHouseLogger->testConnection()) {
                $this->error("Connection failed");
                return 1;
            }
            
            $this->info('✅ Connection successful!');

            // Тестируем логирование
            $this->info('Testing logging...');
            
            // Логируем тестовое SMS
            $clickHouseLogger->logSms(
                '+79991234567',
                'test',
                'success',
                'Test SMS log entry',
                'test_sms_id_123',
                '{"status": "test"}',
                null,
                0.5
            );
            
            // Логируем тестовое Kafka событие
            $clickHouseLogger->logKafka(
                'test-topic',
                'test',
                'success',
                'Test Kafka log entry',
                'test-key',
                0,
                123,
                null,
                0.3
            );
            
            // Логируем тестовый HTTP запрос
            $clickHouseLogger->logHttpRequest(
                'GET',
                '/test/endpoint',
                200,
                150.5,
                'test_user_123',
                '127.0.0.1',
                'Test User Agent',
                1024,
                2048
            );
            
            // Логируем тестовое приложение
            $clickHouseLogger->logApplication(
                'info',
                'Test application log entry',
                'test_context',
                'test_user_123',
                '127.0.0.1',
                'Test User Agent',
                'test_request_123',
                'GET',
                '/test',
                100.0,
                50.5
            );
            
            $this->info('✅ Logging test successful!');

            // Проверяем статистику
            $this->info('Getting log statistics...');
            
            $smsStats = $clickHouseLogger->getLogStats('sms_logs', '1 hour');
            $kafkaStats = $clickHouseLogger->getLogStats('kafka_logs', '1 hour');
            $httpStats = $clickHouseLogger->getLogStats('http_requests', '1 hour');
            $appStats = $clickHouseLogger->getLogStats('application_logs', '1 hour');
            
            $this->table(
                ['Table', 'Total', 'Success', 'Error', 'Avg Time (ms)'],
                [
                    ['sms_logs', $smsStats['data'][0]['total_count'] ?? 0, $smsStats['data'][0]['success_count'] ?? 0, $smsStats['data'][0]['error_count'] ?? 0, round($smsStats['data'][0]['avg_execution_time'] ?? 0, 2)],
                    ['kafka_logs', $kafkaStats['data'][0]['total_count'] ?? 0, $kafkaStats['data'][0]['success_count'] ?? 0, $kafkaStats['data'][0]['error_count'] ?? 0, round($kafkaStats['data'][0]['avg_execution_time'] ?? 0, 2)],
                    ['http_requests', $httpStats['data'][0]['total_count'] ?? 0, $httpStats['data'][0]['success_count'] ?? 0, $httpStats['data'][0]['error_count'] ?? 0, round($httpStats['data'][0]['avg_execution_time'] ?? 0, 2)],
                    ['application_logs', $appStats['data'][0]['total_count'] ?? 0, $appStats['data'][0]['success_count'] ?? 0, $appStats['data'][0]['error_count'] ?? 0, round($appStats['data'][0]['avg_execution_time'] ?? 0, 2)],
                ]
            );
            
            // Показываем информацию о таблицах
            $this->info('Getting tables info...');
            $tablesInfo = $clickHouseLogger->getTablesInfo();
            $tablesSize = $clickHouseLogger->getTablesSize();
            
            if (!isset($tablesInfo['error'])) {
                $this->info('Tables in database:');
                foreach ($tablesInfo as $table) {
                    $this->line("- {$table['name']}");
                }
            }
            
            if (!isset($tablesSize['error'])) {
                $this->info('Tables size:');
                foreach ($tablesSize as $table) {
                    $this->line("- {$table['table']}: {$table['size']} ({$table['parts']} parts)");
                }
            }
            
            $this->info('✅ ClickHouse test completed successfully!');
            return 0;
            
        } catch (\Exception $e) {
            $this->error("Test failed: {$e->getMessage()}");
            return 1;
        }
    }
}
