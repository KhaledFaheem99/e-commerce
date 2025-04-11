<?php

namespace App\Repositories\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Notifications\createProductNotification;

class ProductRepository extends Controller {
    public function productList () {
        return Product::get();
    }

    public function productCreate ($data) {
        return Product::create($data);
    }

    public function productView ($id) {
        return Product::find($id);
    }

    public function productUpdate ($id) {
        return Product::find($id);
    }

    public function productDelete ($id) {
        return Product::find($id);
    }
}