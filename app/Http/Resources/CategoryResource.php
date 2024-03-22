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
        $data = [
            'id' => $this->id,
            'value' => $this->value,
            'label' => $this->label,
            'name' => $this->name,
            'picture' => $this->picture,
            'description' => $this->description,
        ];

        $filteredData = array_filter($data, function($value) {
            return $value != null;
        });

        return $filteredData;
    }
}
