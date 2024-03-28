<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SCPEnemiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'scp' => $this->scp,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'picture' => $this->picture,
            'enemies' => $this->enemies,
        ];

        $filteredData = array_filter($data, function($value) {
            return $value != null;
        });

        return $filteredData;
    }
}
