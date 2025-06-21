<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class notesSeeder extends Seeder
{
    public function run(): void
    {
        notesSeeder::create([
            'id' => '1',
            'title' => 'test note',
            'content' => 'test content',
            'user_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => now(),
            'status_id' => '1',
        ]);
    }
}
