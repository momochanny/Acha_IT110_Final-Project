<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Define API routes for tasks
// Route to get all tasks
Route::get('/tasks', [TaskController::class, 'index']);  // For fetching tasks
Route::post('/tasks', [TaskController::class, 'store']); // For adding a new task
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);// For deleting a task
