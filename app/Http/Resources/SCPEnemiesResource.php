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
        return [
            'scp' => $this->scp,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'picture' => $this->picture,
            'enemies' => $this->enemies,
        ];
    }
}
