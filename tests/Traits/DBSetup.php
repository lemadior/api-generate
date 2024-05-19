<?php

namespace Tests\Traits;

use App\Models\RandomNumber;

trait DBSetup
{
    /**
     * @var array $groups
     */
    protected array $numbers = [ 2, 4, 7, 3, 8, 0, 1, 9, 6 ];

    protected function setDatabase(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            // Assign specified amount of numbers to the table
            RandomNumber::factory()
                ->state(['number' => $this->numbers[$i - 1]])
                ->create();
        }
    }
}
