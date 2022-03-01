<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'product_name' => $this->resource->product_name,
            'product_flavor' => $this->resource->product_flavor,
            'brand_name' => $this->resource->brand_name,
            'brand_logo_path' => $this->resource->brand_logo_path,
        ];
    }
}