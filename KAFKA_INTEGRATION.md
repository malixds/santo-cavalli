# Kafka Integration Guide

## Обзор архитектуры

Проект состоит из двух микросервисов:
- **src** - основной сервис (заказы, SMS, логирование)
- **designs** - сервис для управления дизайнами пользователей

Взаимодействие между сервисами происходит через Apache Kafka.

## Топики Kafka

### 1. `orders` - события заказов
- **События**: `order.created`
- **Отправитель**: основной сервис
- **Получатели**: основной сервис (логирование, аналитика)

### 2. `designs` - события дизайнов
- **События**: 
  - `design.created` - создание дизайна
  - `design.updated` - обновление дизайна
  - `design.deleted` - удаление дизайна
  - `design.status_changed` - изменение статуса
- **Отправитель**: designs сервис
- **Получатели**: основной сервис (логирование, уведомления)

### 3. `notifications` - уведомления
- **События**: произвольные уведомления
- **Отправители**: оба сервиса
- **Получатели**: оба сервиса

## Запуск и тестирование

### 1. Запуск инфраструктуры
```bash
# Запуск всех сервисов
docker compose up -d

# Проверка статуса
docker compose ps
```

### 2. Тестирование Kafka в designs сервисе
```bash
cd designs
docker compose run --rm artisan kafka:test-designs
```

### 3. Тестирование Kafka в основном сервисе
```bash
cd src
docker compose run --rm artisan kafka:test-integration
```

### 4. Запуск консюмеров
```bash
# В основном сервисе - консюмер событий дизайнов
docker compose run --rm artisan kafka:consume-designs

# В основном сервисе - консюмер событий заказов
docker compose run --rm artisan kafka:consume-orders
```

## API Endpoints

### Designs Service (порт 8001)

#### Создание дизайна
```bash
curl -X POST http://localhost:8001/api/designs \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Мой дизайн",
    "description": "Описание дизайна",
    "user_id": "user_123",
    "status": "pending"
  }'
```

#### Получение списка дизайнов
```bash
curl http://localhost:8001/api/designs
```

#### Изменение статуса дизайна
```bash
curl -X PATCH http://localhost:8001/api/designs/design_123/status \
  -H "Content-Type: application/json" \
  -d '{
    "new_status": "approved",
    "reason": "Дизайн одобрен"
  }'
```

## Логирование

Все Kafka события автоматически логируются в ClickHouse:

### Просмотр логов
```bash
# SMS логи
php artisan logs:view sms_logs --limit=20

# Kafka логи
php artisan logs:view kafka_logs --limit=20

# Логи по статусу
php artisan logs:view kafka_logs --status=success --limit=50
```

### Статистика логов
```bash
php artisan clickhouse:test
```

## Мониторинг

### Kafka UI
- **Port**: 9092 (Kafka)
- **Port**: 2181 (Zookeeper)

### ClickHouse UI
- **HTTP**: http://localhost:8123
- **Native**: localhost:9000

## Переменные окружения

### Основной сервис (src/.env)
```env
# Kafka
KAFKA_BROKERS=kafka:9092
KAFKA_CONSUMER_GROUP_ID=main-service
KAFKA_LOGGING_ENABLED=true
KAFKA_LOGGING_LEVEL=info

# ClickHouse
CLICKHOUSE_HOST=clickhouse
CLICKHOUSE_PORT=9000
CLICKHOUSE_USERNAME=default
CLICKHOUSE_PASSWORD=clickhouse
CLICKHOUSE_DATABASE=logs
```

### Designs сервис (designs/.env)
```env
# Kafka
KAFKA_BROKERS=kafka:9092
KAFKA_CONSUMER_GROUP_ID=designs-service
KAFKA_LOGGING_ENABLED=true
KAFKA_LOGGING_LEVEL=info
```

## Troubleshooting

### 1. Kafka недоступен
```bash
# Проверка статуса Kafka
docker compose logs kafka

# Перезапуск Kafka
docker compose restart kafka
```

### 2. ClickHouse недоступен
```bash
# Проверка статуса ClickHouse
docker compose logs clickhouse

# Перезапуск ClickHouse
docker compose restart clickhouse
```

### 3. Ошибки в логах
```bash
# Просмотр логов Laravel
docker compose run --rm artisan pail

# Просмотр логов ClickHouse
php artisan logs:view application_logs --limit=100
```

## Разработка

### Добавление нового события
1. Добавить метод в `KafkaProducer`
2. Добавить обработчик в `KafkaConsumer`
3. Обновить конфигурацию топиков
4. Добавить логирование в ClickHouse

### Добавление нового сервиса
1. Создать Docker сервис
2. Установить Kafka пакет
3. Создать Producer/Consumer
4. Настроить маршруты API
5. Добавить в мониторинг
