<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'year' => $this->year,
            'condition' => $this->condition,
            'defect' => $this->defect,
            'stock' => $this->stock,
            'is_popular' => $this->is_popular,
            'category' => new CategoryResource($this->whenLoaded('categories')),
            'image' => ProductImageResource::collection($this->whenLoaded('productImage'))
        ];
    }
}
