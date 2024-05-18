<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateNumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $newRecord = $this->resource['newRecord'];

        return [
            'id' => $newRecord->id,
            'number' => $newRecord->number
        ];
    }
}
