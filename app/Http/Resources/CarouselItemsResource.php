<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarouselItemsResource extends JsonResource
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
            'product_id' => $this->product->id,
            'title' => $this->product->title,
            'description_short' => $this->product->description_short,
            'price' => $this->product->price,
            'image' => $this->product->images[0],
            'brand_name' => $this->product->brand->brand_name,
            'model_name' => $this->product->model->model_name,
            'material' => $this->product->material->material,
            'color' => $this->product->color->color,
        ];
    }
}
