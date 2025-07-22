<?php

namespace App\Services\Cart;

use App\Interfaces\CartInterfaces\ICartRepository;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartService
{

    public function __construct(private readonly ICartRepository $repository)
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getCart(): Cart
    {
        // Если пользователь авторизован, то:
        if (auth()) {
            // Находим эту корзину по связи с этим пользователем
            $cart = $this->repository->firstOrCreateCart(Auth::id());
            // Если у этой корзины есть корзина из сессии, то нужно объединить их
            if (session()->has('cart_session_id')) {
                $sessionCart = $this->repository->getSessionCart(session('cart_session_id'));
                if ($sessionCart) {
                    $cart->mergeWithSessionCart($sessionCart);
                    session()->forget('cart_session_id');
                }
            }
        } else {
            $sessionId = session()->get('cart_session_id', Str::random(30));
            $cart      = $this->repository->firstOrCreateSessionCart(sessionId: $sessionId);
            session()->put('cart_session_id', $sessionId);
        }

        return $cart;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addToCart($productId, $size, $quantity = 1, $options = [])
    {
        $cart = $this->getCart();
        return $cart->addItem(productId: $productId, size: $size, quantity: $quantity, options: $options);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeFromCart($itemId): int
    {
        $cart = $this->getCart();
        return $cart->removeItem(itemId: $itemId);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updateQuantity(int $itemId, int $quantity): int
    {
        $cart = $this->getCart();
        return $cart->updateQuantity(itemId: $itemId, quantity: $quantity);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function clearCart(): int
    {
        $cart = $this->getCart();
        return $cart->items()->delete();
    }
}
