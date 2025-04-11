<?php

namespace App\Services\Admin\Products;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Products\ProductRepository;

class productServiece extends Controller {
    protected $productRepositroy;

    public function __construct (ProductRepository $productRepositroy) {
        return $this->productRepositroy = $productRepositroy;
    }

    public function productList () {
        $products = $this->productRepositroy->productList();
        if ($products->isEmpty()) {
            return null;
        }
            return $products;
    }

    public function productCreate ($request) {
        $data = $request->validated();
        return  $this->productRepositroy->productCreate($data);
    }

    public function productView ($id) {
        $product = $this->productRepositroy->productView($id);
        if (!$product) {
            return null;
        }
            return $product;
    }

    public function productUpdate ($request , $id) {
        $product = $this->productRepositroy->productUpdate($id);
        $data    = $request->validated();
        if (!$product) {
            return null;
        }
        $product->update($data);
            return $product;
    }

    public function productDelete ($id) {
        $product = $this->productRepositroy->productDelete($id);
        if (!$product) {
            return null;
        }
        $product->delete();
            return $product;
    }
}