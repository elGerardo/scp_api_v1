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
        $data = [
            'scp' => $this->scp,
            'label' => $this->label,
            'value' => $this->value,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'weight' => $this->weight,
            'height' => $this->height,
            'picture' => $this->picture,
            'category' => $this->category,
            'interviews' => $this->interviews,
            'enemies' => $this->enemies
        ];

        $filteredData = array_filter($data, function($value) {
            return $value != null;
        });

        return $filteredData;
    }
}
