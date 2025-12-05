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
Route::middleware('auth')->group(function () {
    Route::resource('task_statuses', TaskStatusController::class)->except(['index']);
});

Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::middleware('auth')->group(function () {
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
});
Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::middleware('auth')->group(function () {
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

Route::get('labels', [LabelController::class, 'index'])->name('labels.index');
Route::middleware('auth')->group(function () {
    Route::resource('labels', LabelController::class)->except(['index']);
});

require __DIR__ . '/auth.php';
