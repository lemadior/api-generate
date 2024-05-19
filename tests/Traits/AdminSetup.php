<?php

namespace Tests\Traits;

use App\Models\User;

trait AdminSetup
{
    protected User $user;

    /**
     * Create fake user for testing purposes only
     *
     * @return User
     */
    private function createUser(): User
    {
        return User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }
}
