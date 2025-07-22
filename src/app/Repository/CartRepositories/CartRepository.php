<?php

namespace App\Repository\CartRepositories;

use App\Interfaces\CartInterfaces\ICartRepository;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartRepository implements ICartRepository
{
    public function add(int $cartId, array $data)
    {

    }

    public function firstOrCreateCart(int $id): Cart
    {
        return Cart::query()->firstOrCreate(['user_id' => Auth::id()]);
    }

    public function firstOrCreateSessionCart(string $sessionId): Cart
    {
        return Cart::query()->firstOrCreate(['session_id' => $sessionId]);
    }


    public function getSessionCart(string $sessionId): ?Cart
    {
        return Cart::query()->where('session_id', $sessionId)->first();
    }
}
