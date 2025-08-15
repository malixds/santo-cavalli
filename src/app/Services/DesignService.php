<?php

namespace App\Services;

use App\DTOs\Kafka\DesignEventDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DesignService
{
    public function __construct(
        private readonly string $designServiceUrl
    ) {
    }

    public function createDesign(DesignEventDTO $dto): array
    {
        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->post(
                    $this->designServiceUrl . '/api/designs',
                    $dto->toArray()
                );

            if ($response->successful()) {
                Log::info('Design created successfully', [
                    'design_id' => $dto->designId,
                    'user_id' => $dto->userId
                ]);

                return ['success' => true];
            }

            Log::warning('Design service returned error', [
                'design_id' => $dto->designId,
                'status_code' => $response->status(),
                'response' => $response->body()
            ]);

            return [
                'success' => false,
                'error' => 'Design service error: ' . $response->status()
            ];

        } catch (\Exception $e) {
            Log::error('Exception while calling design service', [
                'design_id' => $dto->designId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => 'Service unavailable'
            ];
        }
    }
}
