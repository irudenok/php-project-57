<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskStatusPolicy
{
    public function viewAny(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return true;
    }

    public function create(): bool
    {
        return Auth::check();
    }

    public function update(): bool
    {
        return Auth::check();
    }

    public function delete(TaskStatus $taskStatus): bool
    {
        // Запрещаем удаление, если есть связанные задачи
        if ($taskStatus->tasks()->exists()) {
            return false;
        }

        // Разрешаем всем авторизованным удалять пустые статусы
        // Или только админам
        return true; // или return $user->is_admin;
    }

    public function restore(): bool
    {
        return Auth::check();
    }

    public function forceDelete(): bool
    {
        return Auth::check();
    }
}
