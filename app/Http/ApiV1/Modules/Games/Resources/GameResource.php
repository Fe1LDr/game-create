<?php

namespace App\Http\ApiV1\Modules\Games\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'game_name' => $this->game_name,
            'primary_time' => $this->primary_time,
            'added_time' => $this->added_time,
        ];
    }
}
