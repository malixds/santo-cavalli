#!/bin/bash

echo "🛑 Остановка Pepper Crew..."

# Останавливаем контейнеры
echo "📦 Остановка контейнеров..."
docker-compose down

echo "✅ Контейнеры остановлены"
echo "💡 Для полной очистки используйте: ./stop.sh --clean"
