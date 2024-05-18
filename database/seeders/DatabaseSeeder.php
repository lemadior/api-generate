<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RandomNumber;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         RandomNumber::factory(5)->create();

         User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@example.com',
         ]);
    }
}
