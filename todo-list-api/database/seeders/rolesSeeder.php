<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class rolesSeeder extends Seeder
{
    public function run(): void
    {
        roleSeeder::create([
            'id' => '1',
            'status_name' => 'user',
        ]);
    }
}
