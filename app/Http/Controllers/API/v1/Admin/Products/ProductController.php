<?php

namespace App\Http\Controllers\API\v1\Admin\Products;

use App\Http\Controllers\ApiResponse\ApiController;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Admin\Products\productServiece;

class ProductController extends ApiController {
    protected $productService;

    public function __construct (productServiece $productService) {
        return $this->productService = $productService;
    }

    public function index () {
        $products = $this->productService->productList();
        if (!$products){
            return $this->failedResponse('No Products To Show' , 200);
        }
            return $this->successResponse('The Products Listed Successfully' , ProductResource::collection($products) , 200);
    }

    public function store (ProductRequest $request) {
        $product = $this->productService->productCreate($request);
        return     $this->successResponse('Product Created Successfully' , $product , 201);
    }

    public function show ($id) {
        $product = $this->productService->productView($id);
        if (!$product) {
            return $this->failedResponse('Product Not Found' , 404);
        }
        return $this->successResponse('Product Fetched Successfully' , $product , 200);
    } 

    public function update (ProductRequest $request , $id) {
        $product = $this->productService->productUpdate($request , $id);
        if (!$product) {
            return $this->failedResponse('Product Not Found' , 404);
        }
        return $this->successResponse('Product Updated Successfully' , $product , 200);
    }

    public function destroy ($id) {
        $product = $this->productService->productDelete($id);
        if (!$product) {
            return $this->failedResponse('Product Not Found' , 404);
        }
        return $this->successResponse('Product Deleted Successfully' , $product , 200);
    } 
}
