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

Route::resource('task_statuses', TaskStatusController::class)->only(['index', 'show']);
Route::resource('tasks', TaskController::class)->only(['index', 'show']);
Route::resource('labels', LabelController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/task_statuses/create', [TaskStatusController::class, 'create'])->name('task_statuses.create');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/labels/create', [LabelController::class, 'create'])->name('labels.create');

    Route::resource('task_statuses', TaskStatusController::class)->except(['index', 'show', 'create']);
    Route::resource('tasks', TaskController::class)->except(['index', 'show', 'create']);
    Route::resource('labels', LabelController::class)->except(['index', 'show', 'create']);
});

require __DIR__ . '/auth.php';
