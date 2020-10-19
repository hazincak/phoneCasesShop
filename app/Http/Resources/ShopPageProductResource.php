<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopPageProductResource extends JsonResource
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
            'title' => $this->title,
            'price' => $this->price,
            'main_image' => $this->images[0],
            'category_name' => $this->category->category_name,
            'brand_name' => $this->brand->brand_name,
            'model_name' => $this->model->model_name,
        ];
    }
}
