<?php

namespace App\Services\User\Order;

use App\Http\Controllers\Controller;
use App\Repositories\User\Order\OrderRepository;

class OrderServices extends Controller {
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository){
        return $this->orderRepository = $orderRepository;
    }

    public function createOrder ($request) {
        $shippingInformation = $request->validated();
        return $this->orderRepository->createOrder($shippingInformation); 
    }
}