<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('index');
Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
