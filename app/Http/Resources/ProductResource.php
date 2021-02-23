<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $design = $this->whenLoaded('design');
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'offer_id' => $this->offer_id,
            'vendor_id' => $this->vendor_id,
        ];
    }
}
