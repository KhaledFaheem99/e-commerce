<?php

namespace App\Repositories\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderRepository extends Controller {
    public function index () {
        return Order::with('orderItems')->get();
    }
public function findOrder ($id) {
    return Order::find($id);
}
public function update ($id , $currentStatus) {
        $order = Order::find($id);
        $order->update(['status' => $currentStatus]);
        return $order;
    }
}