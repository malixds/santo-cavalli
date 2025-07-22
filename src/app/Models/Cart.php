<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = ['user_id', 'session_id'];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addItem(int $productId, $size, int $quantity = 1, array $options = [])
    {
        $existingItem = $this->items()
            ->where('product_id', $productId)
            ->where('size', $size)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $quantity;
            $existingItem->save();
            return $existingItem;
        }

        return $this->items()->create([
            'product_id' => $productId,
            'quantity'   => $quantity,
            'size'       => $size,
            'options'    => $options
        ]);
    }

    public function removeItem($itemId)
    {
        return $this->items()->where('id', $itemId)->delete();
    }

    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity <= 0) {
            return $this->removeItem($itemId);
        }

        return $this->items()->where('id', $itemId)->update(['quantity' => $quantity]);
    }

    public function totalItems()
    {
        return $this->items()->sum('quantity');
    }

    public function mergeWithSessionCart($sessionCart)
    {
        if ($sessionCart) {
            foreach ($sessionCart->items as $item) {
                $this->addItem($item->product_id, $item->quantity, $item->size, $item->options);
            }

            $sessionCart->delete();
        }
    }
}
