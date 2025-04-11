<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Order_id'       => $this->id,
            'User'           => $this->user->name,
            'Total_Price'    => $this->total_price,
            'Status'         => $this->status,
            'Order_Items'    => $this->orderItems,
            'Shipping_Infos' => $this->shippingInformation
        ];
    }
}
