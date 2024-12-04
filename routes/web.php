<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index'])->name('index');
Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
Route::get('/tasks/{task_id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task_id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task_id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
