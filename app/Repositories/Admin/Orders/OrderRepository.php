<?php

namespace App\Repositories\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderRepository extends Controller {
    public function index () {
        return Order::with('orderItems')->get();
    }

    public function update ($id , $status) {
        $order = Order::with('orderItems')->find($id);
        if (!$order) {
            return null;
        }

        if ($order->status === 'pending' && $status === 'canceled') {
            $order->update(['status' => $status]);
        }

        if ($order->status === 'pending' && $status === 'completed') {
            foreach($order->orderItems as $item) {
                $product = $item->product;
                if ($product->stock >= $item->quantity) {
                    $product->stock -= $item->quantity;
                    $order->update(['status' => $status]);
                    $product->save();
                }else {
                    return false;
                }
            }
        }
        return $order;
    }
}