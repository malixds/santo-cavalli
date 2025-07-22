<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'session_id'];

    public function items()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addItem($productId)
    {
        if (!$this->items()->where('product_id', $productId)->exists()) {
            return $this->items()->create(['product_id' => $productId]);
        }

        return false;
    }

    public function removeItem($productId)
    {
        return $this->items()->where('product_id', $productId)->delete();
    }

    public function mergeWithSessionWishlist($sessionWishlist)
    {
        if ($sessionWishlist) {
            foreach ($sessionWishlist->items as $item) {
                $this->addItem($item->product_id);
            }

            $sessionWishlist->delete();
        }
    }
}
