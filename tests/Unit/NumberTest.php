<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\RandomNumber;
use Tests\Traits\DBSetup;
use Tests\TestCase;

class NumberTest extends TestCase
{
    use RefreshDatabase;
    use DBSetup;

    public function setUp(): void
    {
        parent::setUp();

        $this->setDatabase();
    }

    /**
     * The data set for testing returned value of number and it ID
     *
     * @return array
     */
    public static function numbersProvider(): array
    {
        return [
            [1, 2],
            [2, 4],
            [3, 7],
            [4, 3],
            [5, 8],
            [6, 0],
            [7, 1],
            [8, 9],
            [9, 6]
        ];
    }

    /**
     * A test if the RandomNumber model has been set up 'random_numbers' table correctly.
     *
     * @dataProvider numbersProvider
     *
     */
    public function testNumbersFromDatabase($id, $number): void
    {
        $retrievedNumber = RandomNumber::find($id)->number;

        $this->assertEquals($retrievedNumber, $number);
    }
}
