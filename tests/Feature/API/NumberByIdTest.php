<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\DBSetup;
use Tests\TestCase;

class NumberByIdTest extends TestCase
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
     * A test if the API URI return correct number values.
     *
     * @param $id
     * @param $number
     *
     * @dataProvider numbersProvider
     *
     */
    public function testNumbersFromApi($id, $number): void
    {
        $response = $this->get("/api/v1/numbers/{$id}");

        $response->assertStatus(200);

        $data = $response->json();

        $retrievedNumber = $data['data']['number'];

        $this->assertEquals($retrievedNumber, $number);
    }

    /**
     * A test if the wrong id cause an error.
     *
     * @return void
     *
     */
    public function testNumbersFromApiWithError(): void
    {
        $response = $this->get("/api/v1/numbers/22");

        $response->assertStatus(422);

        $data = $response->json();

        $this->assertArrayHasKey('error', $data);
        $this->assertArrayHasKey('action', $data['error']);
        $this->assertArrayHasKey('message', $data['error']);
        $this->assertEquals('get_number', $data['error']['action']);
        $this->assertEquals('Cannot find number with id=22', $data['error']['message']);
    }
}
