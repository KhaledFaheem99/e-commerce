<?php

namespace App\Services\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Orders\OrderRepository;

class OrderService extends Controller {
    protected $orderRepositroy;
    public function __construct(OrderRepository $orderRepository) {
        return $this->orderRepositroy = $orderRepository;
    }

    public function index () {
        return $this->orderRepositroy->index();
    }

    public function update ($id , $request) {
        $order         = $this->orderRepositroy->findOrder($id);
        if (!$order) {
            return null;
        }

        $status        = $request->input('status');
        $currentStatus = '';
        if ($order->status === 'pending' && $status === 'canceled') {
                    $currentStatus = 'canceled';
        }

        if ($order->status === 'pending' && $status === 'completed') {
            foreach($order->orderItems as $item) {
                $product = $item->product;
                if ($product->stock >= $item->quantity) {
                    $product->stock -= $item->quantity;
                    $product->save();
                }else {
                    return false;
                }
            }
                    $currentStatus = 'completed';
        }

        if ($order->status === 'completed' || $order->status === 'canceled') {  
            return 'orderEnded';
        }

        return $this->orderRepositroy->update($id , $currentStatus)->load('orderItems');
    }
}