<?php

namespace App\Http\Controllers;

use App\DTOs\Kafka\DesignEventDTO;
use App\Http\Requests\UploadDesignRequest;
use App\Services\DesignService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DesignController extends Controller
{
    public function __construct(
        private readonly DesignService $designService
    ) {
    }

    /**
     * Показать страницу создания дизайна
     */
    public function getPage(): View
    {
        return view('pages.design');
    }

    /**
     * Сохранить новый дизайн
     */
    public function storeDesign(UploadDesignRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'error' => 'Authentication required',
                    'message' => 'You must be logged in to perform this action'
                ], 401);
            }

            $designId = Str::uuid()->toString();
            
            $dto = DesignEventDTO::createDesignCreated(
                designId: $designId,
                userId: $user->id,
                title: $request->input('title'),
                description: $request->input('description'),
                status: 'pending'
            );

            $result = $this->designService->createDesign($dto);

            if ($result['success']) {
                return redirect()->back()->with('success', 'Дизайн успешно отправлен');
            }

            Log::error('Failed to create design', [
                'user_id' => $user->id,
                'design_id' => $designId,
                'error' => $result['error'] ?? 'Unknown error'
            ]);

            return redirect()->back()->withErrors('Ошибка при отправке дизайна');

        } catch (\Exception $e) {
            Log::error('Exception while creating design', [
                'user_id' => $user->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withErrors('Произошла внутренняя ошибка сервера');
        }
    }
}
