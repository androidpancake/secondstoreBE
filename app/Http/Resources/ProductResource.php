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

    public $id;
    public $title;
    public $slug;
    public $description;
    public $price;
    public $year;
    public $date_added;
    public $condition;
    public $defect;
    public $stock;
    public $is_popular;
    public $category_id;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->status,
            'title' => $this->message,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'date_added' => $this->date_added,
            'condition' => $this->condition,
            'defect' => $this->defect,
            'stock' => $this->stock,
            'is_popular' => $this->is_popular,
            'category' => new CategoryResource($this->whenLoaded('categories')),
        ];
    }
}
