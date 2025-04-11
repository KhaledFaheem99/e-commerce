<?php

namespace App\Http\Controllers\Api\v1\Filter;

use App\Http\Controllers\ApiResponse\ApiController;
use App\Services\Filter\FilterService;
use Illuminate\Http\Request;

class FilterController extends ApiController {
    protected $filterService;
    public function __construct (FilterService $filterService) {
        return $this->filterService = $filterService;
    }

    public function global (Request $request) {
        $theResult = $this->filterService->global($request);
        if ($theResult == null) {
            return $this->failedResponse('Your Search Is Empty' , 400);
        }
            return $this->successResponse('Success Search' , $theResult , 200);
    }

    public function filter (Request $request) {
        $theResult = $this->filterService->filter($request);

        if (!$theResult) {
            return $this->failedResponse('Your Filter Is Empty' , 400);
        }
        return $this->successResponse('Filter Success' , $theResult , 200);
    }
}
