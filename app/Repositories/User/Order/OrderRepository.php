<?php

namespace App\Repositories\User\Order;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingInformation;
use Illuminate\Support\Facades\Auth;

class OrderRepository {
    public function createOrder ($orderData , $itemsData , $shippingData) {
        $order = Order::create($orderData);
        foreach ($itemsData as $item) {
            $item['order_id'] = $order->id;
            OrderItem::create($item);
        }
        $shippingData['order_id'] = $order->id;
        $shippingData      = ShippingInformation::create($shippingData);
        CartItem::where('user_id' , Auth::id())->delete();
        return $order;
    }
}