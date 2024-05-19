<?php

namespace Tests\Traits;

trait AuthSetup
{
    /**
     * @var string
     */
    protected string $token;

    /**
     * @return string
     */
    private function getApiToken(): string
    {
        $response = $this->actingAs($this->user)->post('/api/v1/auth/login', [
            'email' => 'admin@example.com',
            'password' => 'password'
        ]);

        $data = $response->json();

        return $data['access_token'];
    }
}
