<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
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

    public function update(User $user, Task $task): bool
    {
        return $task->creator->is($user) ||
               ($task->assignee !== null && $task->assignee->is($user));
    }

    public function delete(User $user, Task $task): bool
    {
        return $task->creator->is($user);
    }

    public function restore(User $user, Task $task): bool
    {
        return $task->creator->is($user);
    }

    public function forceDelete(User $user, Task $task): bool
    {
        return $task->creator->is($user);
    }
}
