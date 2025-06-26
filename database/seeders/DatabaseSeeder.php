<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Status;
use App\Models\Note;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создание ролей
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $userRole = Role::factory()->create(['name' => 'user']);

        // Создание статусов
        $noteStatuses = [];
        foreach (['archived', 'completed', 'planned', 'draft'] as $noteStatusName) {
            $noteStatuses[] = Status::factory()->create(['name' => $noteStatusName]);
        }

        // Админ
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id,
        ]);

        // Обычный пользователь
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'role_id' => $userRole->id,
        ]);

        // Дополнительные пользователи
        User::factory(8)->create([
            'role_id' => $userRole->id,
        ]);

        // Для каждого пользователя создаём заметки с разными статусами
        User::query()->each(function (User $user) use ($noteStatuses) {
            /** @var Status $noteStatus */
            foreach ($noteStatuses as $noteStatus) {
                Note::factory(10)->create([
                    'user_id' => $user->id,
                    'status_id' => $noteStatus->id,
                    'deleted_at' => $noteStatus->name === 'archived' ? now() : null,
                ]);
            }
        });
    }
}
