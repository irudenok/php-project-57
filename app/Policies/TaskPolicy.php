<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Task $task): bool
    {
        return true;
    }

    public function create(?User $user): bool
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
