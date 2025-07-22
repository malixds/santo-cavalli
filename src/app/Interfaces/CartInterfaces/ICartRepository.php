<?php

namespace App\Interfaces\CartInterfaces;

use App\Models\Cart;

interface ICartRepository
{
    public function add(int $cartId, array $data);

    public function firstOrCreateCart(int $id): Cart;

    public function firstOrCreateSessionCart(string $sessionId): Cart;

    public function getSessionCart(string $sessionId): ?Cart;
}
