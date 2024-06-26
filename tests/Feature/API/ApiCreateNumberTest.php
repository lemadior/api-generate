<?php

namespace Tests\Feature\API;

use App\Models\RandomNumber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\AdminSetup;
use Tests\Traits\AuthSetup;
use Tests\Traits\DBSetup;
use Tests\TestCase;

class ApiCreateNumberTest extends TestCase
{
    use RefreshDatabase;
    use AuthSetup;
    use AdminSetup;
    use DBSetup;

    protected function setUp(): void
    {
        parent::SetUp();

        $this->user = $this->createUser();
        $this->token = $this->getApiToken();
        $this->setDatabase();
    }

    /**
     * Test creation new numbers' record in 'random_numbers' table via API
     *
     * @return void
     */
    public function testApiCreateNumberWithToken(): void
    {
        $countBefore = RandomNumber::all()->count();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $this->token,
            'Accept' => 'application/json'
        ])->post('/api/v1/numbers');

        $response->assertStatus(200);

        $data = $response->json();

        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('id', $data['data']);
        $this->assertArrayHasKey('number', $data['data']);

        $countAfter = RandomNumber::all()->count();
        $lastRecord = RandomNumber::all()->last();

        $idFromApi = $data['data']['id'];

        $this->assertEquals($lastRecord->id, $idFromApi);
        $this->assertEquals($lastRecord->number, $data['data']['number']);
        $this->assertLessThan($countAfter, $countBefore);
    }

    /**
     * Test try to create new number with unauthorized access to the API URL
     *
     * @return void
     */
    public function testApiCreateNumberWithUnauthorizedError(): void
    {
        $response = $this->post('/api/v1/numbers');

        $response->assertStatus(401);

        $this->assertStringContainsString('Unauthorized', $response->getContent());
    }

    /**
     * A test if the digit limit has been reached.
     *
     * @return void
     *
     */
    public function testCreateNumbersFromApiWithError(): void
    {
        // Create the last available number
        $this->withHeaders([
            'Authorization' => 'Bearer' . $this->token,
            'Accept' => 'application/json'
        ])->post('/api/v1/numbers');

        // Due to set limits of digits in the number here must be impossible
        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $this->token,
            'Accept' => 'application/json'
        ])->post('/api/v1/numbers');

        $response->assertStatus(422);

        $data = $response->json();

        $this->assertArrayHasKey('error', $data);
        $this->assertArrayHasKey('action', $data['error']);
        $this->assertArrayHasKey('message', $data['error']);
        $this->assertEquals('create_number', $data['error']['action']);
        $this->assertEquals('Cannot create new number. Reach maximum of available numbers', $data['error']['message']);
    }
}
