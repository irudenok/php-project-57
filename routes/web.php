<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses.index');
Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('labels', [LabelController::class, 'index'])->name('labels.index');

Route::middleware('auth')->group(function () {
    Route::get('task_statuses/create', [TaskStatusController::class, 'create'])->name('task_statuses.create');
    Route::post('task_statuses', [TaskStatusController::class, 'store'])->name('task_statuses.store');
    Route::get('task_statuses/{task_status}/edit', [TaskStatusController::class, 'edit'])->name('task_statuses.edit');
    Route::patch('task_statuses/{task_status}', [TaskStatusController::class, 'update'])->name('task_statuses.update');
    Route::delete('task_statuses/{task_status}', [TaskStatusController::class, 'destroy'])->name('task_statuses.destroy');

    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('labels/create', [LabelController::class, 'create'])->name('labels.create');
    Route::post('labels', [LabelController::class, 'store'])->name('labels.store');
    Route::get('labels/{label}/edit', [LabelController::class, 'edit'])->name('labels.edit');
    Route::patch('labels/{label}', [LabelController::class, 'update'])->name('labels.update');
    Route::delete('labels/{label}', [LabelController::class, 'destroy'])->name('labels.destroy');
});

Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');

require __DIR__.'/auth.php';
