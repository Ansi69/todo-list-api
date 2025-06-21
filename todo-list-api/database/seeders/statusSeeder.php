<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class statusSeeder extends Seeder
{
    public function run(): void
    {
        statusSeeder::create([
            'id' => '1',
            'name' => 'В процессе',
        ]);
    }
}
