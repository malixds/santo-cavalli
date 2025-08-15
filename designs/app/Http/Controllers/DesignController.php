<?php

namespace App\Http\Controllers;

use App\Services\Kafka\DesignsKafkaProducer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DesignApiController extends Controller
{
    public function __construct(
        private DesignsKafkaProducer $kafkaProducer
    ) {}

    /**
     * Создание нового дизайна
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|string|uuid',
            'status' => 'nullable|string|in:pending,approved,rejected'
        ]);

        // Здесь должна быть логика сохранения в БД
        $designData = [
            'id' => uniqid('design_'), // В реальном проекте используйте UUID
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'created_at' => now()
        ];

        // Отправляем событие в Kafka
        $this->kafkaProducer->sendDesignCreated($designData);

        return response()->json([
            'success' => true,
            'message' => 'Дизайн создан успешно',
            'data' => $designData
        ], 201);
    }

    /**
     * Обновление дизайна
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:pending,approved,rejected'
        ]);

        // Здесь должна быть логика обновления в БД
        $designData = [
            'id' => $id,
            'user_id' => 'user_123', // В реальном проекте получайте из БД
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ];

        // Отправляем событие в Kafka
        $this->kafkaProducer->sendDesignUpdated($designData);

        return response()->json([
            'success' => true,
            'message' => 'Дизайн обновлен успешно',
            'data' => $designData
        ]);
    }

    /**
     * Удаление дизайна
     */
    public function destroy(string $id): JsonResponse
    {
        // Здесь должна быть логика удаления из БД
        $designData = [
            'id' => $id,
            'user_id' => 'user_123' // В реальном проекте получайте из БД
        ];

        // Отправляем событие в Kafka
        $this->kafkaProducer->sendDesignDeleted($designData);

        return response()->json([
            'success' => true,
            'message' => 'Дизайн удален успешно'
        ]);
    }

    /**
     * Изменение статуса дизайна
     */
    public function changeStatus(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'new_status' => 'required|string|in:pending,approved,rejected',
            'reason' => 'nullable|string'
        ]);

        // Здесь должна быть логика изменения статуса в БД
        $designData = [
            'id' => $id,
            'user_id' => 'user_123', // В реальном проекте получайте из БД
            'old_status' => 'pending', // В реальном проекте получайте из БД
            'new_status' => $request->new_status,
            'reason' => $request->reason
        ];

        // Отправляем событие в Kafka
        $this->kafkaProducer->sendDesignStatusChanged($designData);

        return response()->json([
            'success' => true,
            'message' => 'Статус дизайна изменен успешно',
            'data' => [
                'design_id' => $id,
                'new_status' => $request->new_status
            ]
        ]);
    }

    /**
     * Получение списка дизайнов
     */
    public function index(): JsonResponse
    {
        // Здесь должна быть логика получения из БД
        $designs = [
            [
                'id' => 'design_1',
                'title' => 'Пример дизайна 1',
                'description' => 'Описание дизайна 1',
                'status' => 'pending',
                'user_id' => 'user_123'
            ],
            [
                'id' => 'design_2',
                'title' => 'Пример дизайна 2',
                'description' => 'Описание дизайна 2',
                'status' => 'approved',
                'user_id' => 'user_456'
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $designs
        ]);
    }

    /**
     * Получение дизайна по ID
     */
    public function show(string $id): JsonResponse
    {
        // Здесь должна быть логика получения из БД
        $design = [
            'id' => $id,
            'title' => 'Пример дизайна',
            'description' => 'Описание дизайна',
            'status' => 'pending',
            'user_id' => 'user_123',
            'created_at' => now()->toISOString()
        ];

        return response()->json([
            'success' => true,
            'data' => $design
        ]);
    }
}
