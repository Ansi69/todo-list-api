<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), // Заголовок из 3 слов
            'content' => $this->faker->paragraph(), // Случайный абзац
            'user_id' => User::factory(), // Связь с User
            'status_id' => Status::factory(), // Связь с Status
        ];
    }
}
