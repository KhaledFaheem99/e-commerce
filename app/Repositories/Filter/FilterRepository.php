<?php

namespace App\Repositories\Filter;

use App\Http\Controllers\Controller;
use App\Models\Product;

class FilterRepository extends Controller {
    public function global ($search) {
        return Product::where('name' , 'like' , '%' .$search. '%')->get();
    }

    public function filter ($category , $size , $brand , $stock , $minPrice , $maxPrice) {
        $query = Product::query();

        if ($category) {
            $query->where('category_id' , $category);
        }

        if ($size) {
            $query->where('size' , $size);
        }

        if ($brand) {
            $query->where('brand' , $brand);
        }

        if ($stock) {
            $query->where('stock' , '>' , 0);
        }

        if ($minPrice) {
            $query->where('price' , '>=' , $minPrice);
        }

        if ($maxPrice) {
            $query->where('price' , '<=' , $maxPrice);
        }

        if ($maxPrice && $minPrice) {
            $query->whereBetween('price' , [$minPrice , $maxPrice]);
        }

        return $query->get();
    }
}