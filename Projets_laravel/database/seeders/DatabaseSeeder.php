<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'login'        => 'TestUser',
            'email'        => 'test@example.com',
            'phone_number' => '0700000000',
        ]);

        $this->call([
            CategorySeeder::class,
        ]);
    }
}