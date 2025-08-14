<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Kafka Configuration for Designs Service
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Kafka messaging in designs service.
    | Configure brokers, topics, and consumer groups here.
    |
    */

    'brokers' => env('KAFKA_BROKERS', 'kafka:9092'),

    'consumer_group_id' => env('KAFKA_CONSUMER_GROUP_ID', 'designs-service'),

    'topics' => [
        'designs' => [
            'name' => 'designs',
            'partitions' => 3,
            'replicas' => 1,
        ],
        'notifications' => [
            'name' => 'notifications',
            'partitions' => 2,
            'replicas' => 1,
        ],
    ],

    'producers' => [
        'default' => [
            'brokers' => env('KAFKA_BROKERS', 'kafka:9092'),
            'acks' => 1,
            'retries' => 3,
            'batch_size' => 16384,
            'linger_ms' => 10,
        ],
    ],

    'consumers' => [
        'default' => [
            'brokers' => env('KAFKA_BROKERS', 'kafka:9092'),
            'group_id' => env('KAFKA_CONSUMER_GROUP_ID', 'designs-service'),
            'auto_offset_reset' => 'earliest',
            'enable_auto_commit' => true,
            'auto_commit_interval_ms' => 1000,
            'session_timeout_ms' => 30000,
            'heartbeat_interval_ms' => 3000,
        ],
    ],

    'middleware' => [
        'producer' => [
            // Middleware для продюсеров
        ],
        'consumer' => [
            // Middleware для консюмеров
        ],
    ],

    'logging' => [
        'enabled' => env('KAFKA_LOGGING_ENABLED', true),
        'level' => env('KAFKA_LOGGING_LEVEL', 'info'),
    ],
];
