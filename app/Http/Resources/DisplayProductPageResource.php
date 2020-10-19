<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DisplayProductPageResource extends JsonResource
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
            'description_short' => $this->description_short,
            'description_long' => $this->description_long,
            'price' => $this->price,
            'images' => $this->images,
            'category_name' => $this->category->category_name,
            'brand_name' => $this->brand->brand_name,
            'model_name' => $this->model->model_name,
            'material' => $this->material->material,
            'color' => $this->color->color,
        ];
    }
}
