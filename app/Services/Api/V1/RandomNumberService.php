<?php

namespace App\Services\Api\V1;

use App\Models\RandomNumber;
use RuntimeException;

class RandomNumberService
{
    /**
     * Get record from database by ID
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getRecordById(int $id)
    {
        $randomNumber = RandomNumber::find($id);

        if (!$randomNumber) {
            throw new RuntimeException("Cannot find number with id={$id}");
        }

        return $randomNumber;
    }
}
