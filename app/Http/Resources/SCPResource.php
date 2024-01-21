<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SCPResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "name" => $this->name,
            "description" => $this->description,
            "weight" => $this->weight,
            "height" => $this->height,
            "picture" => $this->picture,
            "category_id" => $this->category_id
        ];
    }
}
