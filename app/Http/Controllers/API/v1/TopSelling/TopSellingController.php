<?php

namespace App\Http\Controllers\Api\v1\TopSelling;

use App\Http\Controllers\ApiResponse\ApiController;
use App\Services\TopSelling\TopSellingService;

class TopSellingController extends ApiController {
    protected $serviceTopSelling;
    public function __construct(TopSellingService $serviceTopSelling) {
        return $this->serviceTopSelling = $serviceTopSelling;
    }

    public function getTopSelling () {
        $product = $this->serviceTopSelling->getTopSelling();
        if (!$product) {
            return $this->failedResponse('No product' , 400);
        }
        return $this->successResponse('Successfully obtained the best-selling product' , $product , 200);
    }
}
