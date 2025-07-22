<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\UpdateItemQuantityInCart;
use App\Models\Collection;
use App\Services\Cart\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartController extends Controller
{
    public function __construct(private CartService $cartService)
    {
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        return view('cart.index', compact('cart'));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addItem(AddProductToCartRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->cartService->addToCart(productId: $data['product_id'], quantity: $data['size']);

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeItem($itemId): RedirectResponse
    {
        $this->cartService->removeFromCart($itemId);
        return redirect()->back()->with('success', 'Товар удален из корзины');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updateItem(UpdateItemQuantityInCart $request, $itemId): RedirectResponse
    {
        $this->cartService->updateQuantity($itemId, $request->quantity);
        return redirect()->back()->with('success', 'Количество обновлено');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function clear(): RedirectResponse
    {
        $this->cartService->clearCart();
        return redirect()->back()->with('success', 'Корзина очищена');
    }
}
