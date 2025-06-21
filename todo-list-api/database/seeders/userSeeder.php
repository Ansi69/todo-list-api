<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    public function run(): void
    {
        userSeeder::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'rememberToken' => random_int(1, 100),
            'timestamps' => now(),
        ]);
    }
}
