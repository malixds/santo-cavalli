<?php

return [
    'smsru' => [
            'api_key' => env('SMSRU_API_KEY'),
            'base_url' => env('SMSRU_BASE_URL', 'https://sms.ru'),
            'cache_ttl' => env('SMSRU_CACHE_TTL', 300), // 5 минут
    ],
    
    'clickhouse' => [
        'host' => env('CLICKHOUSE_HOST', 'clickhouse'),
        'port' => env('CLICKHOUSE_PORT', 9000),
        'username' => env('CLICKHOUSE_USERNAME', 'default'),
        'password' => env('CLICKHOUSE_PASSWORD', 'clickhouse'),
        'database' => env('CLICKHOUSE_DATABASE', 'logs'),
    ],
];
