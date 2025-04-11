<?php

namespace App\Repositories\User\Order;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingInformation;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends Controller {
    public function createOrder ($shippingInformation) {
        $cartItems = CartItem::where('user_id' , Auth::id())->get();
        if ($cartItems->isEmpty()){
            return null;
        }
        $order = Order::create([
            'user_id'     => Auth::id(),
            'total_price' => 0,
            'status'      => 'pending'
        ]);
        $totalprice = 0;
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price
            ]);
            $totalprice += $item->product->price * $item->quantity;
        }
        $order->update(['total_price' => $totalprice]);
        $shippingData             = $shippingInformation;
        $shippingData['order_id'] = $order->id;
        $shippingInformation      = ShippingInformation::create($shippingData);
        CartItem::where('user_id' , Auth::id())->delete();
        return $order;
    }
}