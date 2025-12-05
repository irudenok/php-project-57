<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем 10 пользователей (авторов и исполнителей)
        $users = User::factory(10)->create();

        // Получаем все статусы
        $statuses = TaskStatus::all();

        // Создаем метки
        $labels = Label::factory(15)->create();

        // Создаем 20 задач с случайными авторами и исполнителями
        Task::factory(20)->create([
            'created_by_id' => fn() => $users->random()->id,
            'assigned_to_id' => fn() => fake()->boolean(70) ? $users->random()->id : null,
            'status_id' => fn() => $statuses->random()->id,
        ])->each(function ($task) use ($labels) {
            // Случайно добавляем метки к задачам
            if (fake()->boolean(60)) {
                $taskLabels = $labels->random(rand(1, 3));
                $task->labels()->attach($taskLabels->pluck('id'));
            }
        });
    }
}
