<?php

namespace App\Services\Filter;

use App\Http\Controllers\Controller;
use App\Repositories\Filter\FilterRepository;


class FilterService extends Controller {
    protected $filterRepository;
    public function __construct (FilterRepository $filterRepository) {
        return $this->filterRepository = $filterRepository;
    }
    public function global ($request) {
        $search     = $request->input('name');
        if (!$search) {
            return null;
        }
        return $this->filterRepository->global($search);
    }

    public function filter ($request) {
        $category = $request->input('category_id' , null);
        $size     = $request->input('size'        , null);
        $brand    = $request->input('brand'       , null);
        $stock    = $request->input('stock'       , null);
        $minPrice = $request->input('minPrice'    , null);
        $maxPrice = $request->input('maxPrice'    , null);

        if (empty($request->all())){
            return null;
        }
        return $this->filterRepository->filter($category , $size , $brand , $stock , $minPrice , $maxPrice);
    }
}