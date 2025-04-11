<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ItemID'         => $this->id,
            'User_id'        => $this->user_id,
            'QuantityOfItem' => $this->quantity,
            'Product'        => new ProductResource($this->product),
        ];
    }
}
