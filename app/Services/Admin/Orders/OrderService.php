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
        $status = $request->input('status');
        return $this->orderRepositroy->update($id , $status);
    }
}