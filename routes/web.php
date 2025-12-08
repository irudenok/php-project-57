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
    Route::resource('task_statuses', TaskStatusController::class)->except(['index', 'show']);
    Route::resource('tasks', TaskController::class)->except(['index', 'show']);
    Route::resource('labels', LabelController::class)->except(['index', 'show']);
});

require __DIR__ . '/auth.php';
