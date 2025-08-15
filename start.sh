#!/bin/bash

echo "🚀 Запуск Pepper Crew..."

# Проверяем, что Docker запущен
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker не запущен. Запустите Docker Desktop"
    exit 1
fi

# Запускаем контейнеры
echo "📦 Запуск контейнеров..."
docker-compose up -d

# Ждем немного для полного запуска
echo "⏳ Ожидание запуска сервисов..."
sleep 5

# Проверяем статус
echo "🔍 Проверка статуса контейнеров..."
docker-compose ps

# Проверяем доступность сайта
echo "🌐 Проверка доступности сайта..."
if curl -s -o /dev/null -w "%{http_code}" http://localhost | grep -q "200"; then
    echo "✅ Сайт доступен: http://localhost"
else
    echo "⚠️  Сайт может быть еще не готов, попробуйте через минуту"
fi

echo "🎉 Готово! Откройте http://localhost в браузере"
