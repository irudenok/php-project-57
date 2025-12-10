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

Route::get('/task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses.index');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/labels', [LabelController::class, 'index'])->name('labels.index');

Route::middleware('auth')->group(function () {
    Route::get('/task_statuses/create', [TaskStatusController::class, 'create'])->name('task_statuses.create');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/labels/create', [LabelController::class, 'create'])->name('labels.create');
});

Route::get('/task_statuses/{task_status}', [TaskStatusController::class, 'show'])->name('task_statuses.show');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/labels/{label}', [LabelController::class, 'show'])->name('labels.show');

Route::middleware('auth')->group(function () {
    Route::resource('task_statuses', TaskStatusController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::resource('tasks', TaskController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::resource('labels', LabelController::class)->only(['store', 'edit', 'update', 'destroy']);
});

require __DIR__ . '/auth.php';
