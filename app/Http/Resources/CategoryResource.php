<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attributes = $this->resource->getAttributes();

        # Trả về ngoại trừ các field
        // return collect($attributes)->except(['id', 'created_at', 'updated_at']);

        # Chỉ trả về những field được định nghĩa
         return collect($attributes)->only(['name', 'slug', 'image', 'is_activate']);

        # Mặc đinh: trả về toàn bộ field của model
        // return parent::toArray($request);
    }
}
