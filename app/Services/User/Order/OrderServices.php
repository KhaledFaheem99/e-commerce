<?php

namespace App\Services\User\Order;

use App\Http\Controllers\Controller;
use App\Repositories\User\CartItem\CartItemRepository;
use App\Repositories\User\Order\OrderRepository;
use Illuminate\Support\Facades\Auth;


class OrderServices extends Controller {
    protected $orderRepository;
    protected $cartItemsRepository;

    public function __construct(OrderRepository $orderRepository , CartItemRepository $cartItemsRepository){
        $this->orderRepository     = $orderRepository;
        $this->cartItemsRepository = $cartItemsRepository;
    }

    public function createOrder ($request) {
        $shippingData  = $request->validated();
        $cartItems     = $this->cartItemsRepository->showCart();
        if ($cartItems->isEmpty()) {
            return null;
        }
        $orderData     = [
            'user_id'     => Auth::id(),
            'total_price' => 0,
            'status'      => 'pending'
        ];
        $itemsData     = [];
        $totalPrice    = 0;
        foreach ($cartItems as $item) {
            $price     = $item->product->price;
            $totalPrice += $price * $item->quantity;
            $itemsData[] = [
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $price
            ];
        }
        $orderData['total_price'] = $totalPrice;
        return $this->orderRepository->createOrder($orderData , $itemsData , $shippingData); 
    }
}