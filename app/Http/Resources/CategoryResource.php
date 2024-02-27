<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'catname' => $this->catname,
            'code' => $this->code,
            'subcategories' => SubcategoryResource::collection($this->whenLoaded('subcategories')),
            'subcategories_count' => $this->whenCounted('subcategories'),
        ];
    }
}
