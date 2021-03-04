<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'type' => $this->type->name,
          'description' => $this->description,
           'image' => new ImageResource($this->image),
           'product' => new ProductResource($this->product)
        ];
    }
}
