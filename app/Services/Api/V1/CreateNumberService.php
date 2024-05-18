<?php

namespace App\Services\Api\V1;

use App\Models\RandomNumber;
use Random\RandomException;
use RuntimeException;

class CreateNumberService
{
    /**
     * @var int $maxNumber
     */
    protected int $maxNumber;

    public function __construct()
    {
        $nbDigit = (int)env('RANDOM_NUMBER_DIGITS', 2);

        $this->maxNumber = 10 ** $nbDigit - 1;
    }

    /**
     * Generate new randomized number based on the amount of the digits.
     * Generated number is unique
     *
     * @return RandomNumber
     *
     * @throws RandomException
     * @throws RuntimeException
     */
    public function createNewNumber(): RandomNumber
    {
        if ($this->getTotalNumbers() > $this->maxNumber) {
            throw new RuntimeException('Cannot create new number. Reach maximum of available numbers');
        }

        $nonexistent = true;

        $number = -1;

        while ($nonexistent) {
            $number = random_int(0, $this->maxNumber);

            $isExist = (bool)RandomNumber::where('number', $number)->first();

            if ($isExist) {
                continue;
            }

            $nonexistent = false;
        }

        return RandomNumber::create(['number' => $number]);
    }

    /**
     * Count total count of numbers stored in the database
     *
     * @return int
     */
    protected function getTotalNumbers(): int
    {
        return RandomNumber::all()->count();
    }
}
