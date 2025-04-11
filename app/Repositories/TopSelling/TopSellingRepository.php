<?php

namespace App\Repositories\TopSelling;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TopSellingRepository extends Controller {
    public function getTopSelling () {
        $topSellingProduct = OrderItem::select('product_id' , DB::raw('SUM(quantity) as total_sales'))
        ->groupBy('product_id')
        ->orderByDesc('total_sales')
        ->first();
        if ($topSellingProduct) {
            $product = Product::find($topSellingProduct->product_id);
        }else {
            return null;
        }
        return $product;
    }
}