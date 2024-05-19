<?php

namespace Tests\Traits;

use App\Models\RandomNumber;

trait DBSetup
{
    /**
     * @var array $numbers
     */
    protected array $numbers = [ 2, 4, 7, 3, 8, 0, 1, 9, 6 ];

    /**
     * Assign specified amount of numbers to the table
     *
     * @return void
     */
    protected function setDatabase(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            RandomNumber::factory()
                ->state(['number' => $this->numbers[$i - 1]])
                ->create();
        }
    }
}
