<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskStatusController extends Controller
{
    public function index(): View
    {
        $taskStatuses = TaskStatus::orderBy('id')->paginate(10);
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create(): View
    {
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(StoreTaskStatusRequest $request): RedirectResponse
    {
        TaskStatus::create($request->validated());
        flash('Статус успешно создан')->success();
        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): View
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->update($request->validated());
        flash('Статус успешно изменён')->success();
        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->tasks()->exists()) {
            flash('Не удалось удалить статус')->error();
            return redirect()->route('task_statuses.index');
        }

        $taskStatus->delete();
        flash('Статус успешно удалён')->success();
        return redirect()->route('task_statuses.index');
    }
}
