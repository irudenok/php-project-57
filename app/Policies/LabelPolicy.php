<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LabelPolicy
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

    public function delete(Label $label): bool
    {
        // Запрещаем удаление, если есть связанные задачи
        if ($label->tasks()->exists()) {
            return false;
        }

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
