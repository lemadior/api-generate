<?php

namespace App\Http\Resources\Api\V1;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use RuntimeException;

class RandomNumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws RuntimeException
     */
    public function toArray(Request $request): array
    {
        $foundedRecord = $this->resource['foundedRecord'];

        return [
            'id' => $foundedRecord->id,
            'number' => $foundedRecord->number
        ];
    }
}
