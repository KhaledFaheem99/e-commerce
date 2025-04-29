<?php

namespace App\Repositories\User\CartItem;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartItemRepository {
    public function addToCart ($id , $data) {
        $item = CartItem::where('user_id' , Auth::id())->where('product_id' , $id)->first();
        if ($item) {
            return null;
        }
        return CartItem::create($data);
    }

    public function showCart () {
        return CartItem::where('user_id' , Auth::id())->get();
    }

    public function updateCart ($id) {
        return CartItem::where('user_id' , Auth::id())->where('product_id' , $id)->first();
    }

    public function getProduct ($id) {
        return Product::where('id' , $id)->first();
    }

    public function removeFromCart ($id) {
        return CartItem::where('product_id' , $id)->where('user_id' , Auth::id())->first();
    }
}