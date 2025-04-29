<?php

namespace App\Http\Controllers\Api\v1\Admin\Orders;

use App\Http\Controllers\ApiResponse\ApiController;
use App\Services\Admin\Orders\OrderService;
use Illuminate\Http\Request;

class OrderAdminController extends ApiController {
    protected $orderService;
    public function __construct(OrderService $orderService) {
        return $this->orderService = $orderService;
    }

    public function index () {
        $orders = $this->orderService->index();
        if (!$orders) {
            return $this->failedResponse('No Orders' , 400);
        }
        return $this->successResponse('The Orders Showed Successfully' , $orders , 200);
    }

    public function update (Request $request, $id) {
        $order = $this->orderService->update($id , $request);
        if ($order === null) {
            return $this->failedResponse('Order Not Found' , 404);
        }
        if ($order === false) {
            return $this->failedResponse('This Quantity Not Available In Stock' , 400);
        }
        if ($order === 'orderEnded') {
            return $this->failedResponse('Order Status Cant Updated' , 400);
        }
        return $this->successResponse('Order Status Updated Successfully' , $order , 200);
    }
}
