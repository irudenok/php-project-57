<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = QueryBuilder::for(Task::class)
            ->with(['status', 'creator', 'assignee', 'labels'])
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->allowedSorts(['id', 'created_at'])
            ->defaultSort('id')
            ->paginate(10)
            ->withQueryString();

        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('tasks.index', compact('tasks', 'statuses', 'users', 'labels'));
    }

    public function create(): View
    {
        $task = new Task();
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('tasks.create', compact('task', 'statuses', 'users', 'labels'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by_id'] = Auth::id();
        $labelIds = $data['label_ids'] ?? [];
        unset($data['label_ids']);

        $task = Task::create($data);
        $task->labels()->sync($labelIds);

        flash('Задача успешно создана')->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        $task->load(['status', 'creator', 'assignee', 'labels']);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();
        $labelIds = $data['label_ids'] ?? [];
        unset($data['label_ids']);

        $task->update($data);
        $task->labels()->sync($labelIds);

        flash('Задача успешно изменена')->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        if ($task->created_by_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        flash('Задача успешно удалена')->success();
        return redirect()->route('tasks.index');
    }
}
