<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, TaskStatus $taskStatus): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, TaskStatus $taskStatus): bool
    {
        // Если нет created_by_id, разрешаем всем авторизованным
        // Или запрещаем всем, кроме админа
        return true; // или return $user->is_admin;
    }

    public function delete(User $user, TaskStatus $taskStatus): bool
    {
        // Запрещаем удаление, если есть связанные задачи
        if ($taskStatus->tasks()->exists()) {
            return false;
        }

        // Разрешаем всем авторизованным удалять пустые статусы
        // Или только админам
        return true; // или return $user->is_admin;
    }

    public function restore(User $user, TaskStatus $taskStatus): bool
    {
        return true; // или return $user->is_admin;
    }

    public function forceDelete(User $user, TaskStatus $taskStatus): bool
    {
        return true; // или return $user->is_admin;
    }
}
