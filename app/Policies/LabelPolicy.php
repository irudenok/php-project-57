<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;

class LabelPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Label $label): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Label $label): bool
    {
        // Если нет created_by_id
        return true; // или return $user->is_admin;
    }

    public function delete(User $user, Label $label): bool
    {
        // Запрещаем удаление, если есть связанные задачи
        if ($label->tasks()->exists()) {
            return false;
        }

        return true; // или return $user->is_admin;
    }

    public function restore(User $user, Label $label): bool
    {
        return true; // или return $user->is_admin;
    }

    public function forceDelete(User $user, Label $label): bool
    {
        return true; // или return $user->is_admin;
    }
}
