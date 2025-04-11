<?php

namespace App\Http\Controllers\API\v1\User\CartItem;

use App\Http\Controllers\ApiResponse\ApiController;
use App\Http\Requests\CartItem\CartItemRequest;
use App\Http\Requests\CartItem\cartItemUpdateRequest;
use App\Http\Resources\CartItemsResource;
use App\Services\User\CartItem\cartItemService;

class CartItemController extends ApiController {
    protected $cartItemService;

    public function __construct (cartItemService $cartItemService) {
        return $this->cartItemService = $cartItemService;
    }

    public function addToCart (CartItemRequest $request) {
        $item = $this->cartItemService->addToCart($request);
        if (!$item) {
            return $this->failedResponse('This Item Already In Cart' , 400);
        }
        return $this->successResponse('Item Added To Cart Successfully' , $item , 200);
    }

    public function showCart () {
        $userCart = $this->cartItemService->showCart();
        return $this->successResponse('UserCart Showed Is Successfully' , CartItemsResource::collection($userCart) , 200);
    }

    public function updateCart (cartItemUpdateRequest $request , $id) {
        $cartItem = $this->cartItemService->updateCart($request , $id);
        if ($cartItem === null) {
            return $this->failedResponse('Sorry, This Item Not Found In The Cart' , 404);
        }
        if ($cartItem === false) {
            return $this->failedResponse('Sorry, This Quantity Is Not Available In Stock' , 404);
        }
            return $this->successResponse('The Item Quantity Updated Successfully' , new CartItemsResource($cartItem) , 200);
    }

    public function removeFromCart ($id) {
        $item = $this->cartItemService->removeFromCart($id);
        if (!$item) {
            return $this->failedResponse('The Item Not Found' , 404);
        }
            return $this->successResponse('The Item Deleted Successfully' , $item , 200);
    }
}
