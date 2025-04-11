<?php

namespace App\Services\User\CartItem;

use App\Http\Controllers\Controller;
use App\Repositories\User\CartItem\CartItemRepository;
use Illuminate\Support\Facades\Auth;

class cartItemService extends Controller {
    protected $cartItemRepository;

    public function __construct (CartItemRepository $cartItemRepository) {
        return $this->cartItemRepository = $cartItemRepository;
    }

    public function addToCart ($request) {
        $product_id = $request->product_id;
        $data = [
            'user_id'    => Auth::id(),
            'product_id' => $request->product_id,
            'stock'      => $request->stock
        ];
        return $this->cartItemRepository->addToCart($product_id , $data);
    }

    public function showCart () {
        return $this->cartItemRepository->showCart();
    }

    public function updateCart ($request , $id) {
        $item           = $this->cartItemRepository->updateCart($id);
        $product        = $this->cartItemRepository->getProduct($id);
        if (!$item) {
            return null;
        }
        if ($request->quantity > $product->stock) {
            return false;
        }
        $item->quantity = $request->quantity;
        $item->save();
        return $item;
    }

    public function removeFromCart ($id) {
        $item = $this->cartItemRepository->removeFromCart($id);
        if (!$item) {
            return null;
        }
        $item->delete();
        return $item;
    }
}