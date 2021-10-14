<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserJoinProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [ProjectController::class, 'dashboard'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::delete('projects/{project}/users/{user}', [UserJoinProjectController::class, 'destroy']);
    Route::resource('projects/{project}/tasks', TaskController::class);
    Route::get('projects/{project}/progress', [TaskController::class, 'progress'])->name('tasks.progress');
    Route::resource('projects/{project}/tasks/{task}/comments', TaskCommentController::class);
});
