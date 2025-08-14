-- Создание базы данных для логов
CREATE DATABASE IF NOT EXISTS logs;

-- Таблица для общих логов приложения
CREATE TABLE IF NOT EXISTS logs.application_logs
(
    id UUID DEFAULT generateUUIDv4(),
    timestamp DateTime64(3) DEFAULT now(),
    level LowCardinality(String),
    message String,
    context String,
    user_id Nullable(String),
    ip_address Nullable(String),
    user_agent Nullable(String),
    request_id Nullable(String),
    method Nullable(String),
    url Nullable(String),
    execution_time_ms Nullable(Float32),
    memory_usage_mb Nullable(Float32),
    created_at DateTime64(3) DEFAULT now()
)
ENGINE = MergeTree()
PARTITION BY toYYYYMM(timestamp)
ORDER BY (timestamp, level, message)
TTL timestamp + INTERVAL 1 YEAR;

-- Таблица для SMS логов
CREATE TABLE IF NOT EXISTS logs.sms_logs
(
    id UUID DEFAULT generateUUIDv4(),
    timestamp DateTime64(3) DEFAULT now(),
    phone String,
    action LowCardinality(String), -- 'send', 'verify', 'balance_check'
    status LowCardinality(String), -- 'success', 'error'
    message String,
    sms_id Nullable(String),
    api_response String,
    error_message Nullable(String),
    execution_time_ms Nullable(Float32),
    created_at DateTime64(3) DEFAULT now()
)
ENGINE = MergeTree()
PARTITION BY toYYYYMM(timestamp)
ORDER BY (timestamp, phone, action)
TTL timestamp + INTERVAL 1 YEAR;

-- Таблица для Kafka логов
CREATE TABLE IF NOT EXISTS logs.kafka_logs
(
    id UUID DEFAULT generateUUIDv4(),
    timestamp DateTime64(3) DEFAULT now(),
    topic String,
    action LowCardinality(String), -- 'publish', 'consume', 'error'
    status LowCardinality(String), -- 'success', 'error'
    message String,
    key Nullable(String),
    partition Nullable(Int32),
    offset Nullable(Int64),
    error_message Nullable(String),
    execution_time_ms Nullable(Float32),
    created_at DateTime64(3) DEFAULT now()
)
ENGINE = MergeTree()
PARTITION BY toYYYYMM(timestamp)
ORDER BY (timestamp, topic, action)
TTL timestamp + INTERVAL 1 YEAR;

-- Таблица для HTTP запросов
CREATE TABLE IF NOT EXISTS logs.http_requests
(
    id UUID DEFAULT generateUUIDv4(),
    timestamp DateTime64(3) DEFAULT now(),
    method LowCardinality(String),
    url String,
    status_code Int16,
    response_time_ms Float32,
    user_id Nullable(String),
    ip_address String,
    user_agent Nullable(String),
    request_size_bytes Nullable(Int32),
    response_size_bytes Nullable(Int32),
    created_at DateTime64(3) DEFAULT now()
)
ENGINE = MergeTree()
PARTITION BY toYYYYMM(timestamp)
ORDER BY (timestamp, method, status_code)
TTL timestamp + INTERVAL 1 YEAR;

-- Создание пользователя для приложения (опционально)
CREATE USER IF NOT EXISTS app_user IDENTIFIED WITH plaintext_password BY 'app_password';
GRANT ALL ON logs.* TO app_user;
