<?php

namespace App\Http\Controllers\API\v1\User\Order;

use App\Http\Controllers\ApiResponse\ApiController;
use App\Http\Requests\ShippingInformation\ShippingInformationRequest;
use App\Http\Resources\OrderResource;
use App\Services\User\Order\OrderServices;

class OrderController extends ApiController {
    protected $orderServices;

    public function __construct(OrderServices $orderServices) {
        return $this->orderServices = $orderServices;
    }

    public function store (ShippingInformationRequest $request) {
        $order = $this->orderServices->createOrder($request);
        if ($order === null) {
            return $this->failedResponse('Your Cart Is Empty' , 400);
        }
            return $this->successResponse('Order Created Successfully' , new OrderResource($order) , 201);
    }
}
