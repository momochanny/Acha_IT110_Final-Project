<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        // Fetch all tasks
        $tasks = Task::all();
    
        // Return tasks as JSON response
        return response()->json($tasks);
    }
    
    
    // Render Inertia page
    public function list()
    {
        return Inertia::render('TodoList');
    }
    
    public function store(Request $request)
{
    // Validate incoming data
    $request->validate([
        'title' => 'required|string|max:255',  // Ensure title is provided and is a string
    ]);

    // Create a new task and save it to the database
    $task = Task::create([
        'title' => $request->title,       // Insert the title
        'completed' => false, // Insert the completed status
    ]);

    // Return the created task as JSON
    return response()->json($task, 201); // Return the new task with a 201 status code
}

public function update(Request $request, Task $task)
{
    // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255', // Ensure title is a string and not empty
        'completed' => 'required|boolean',    // Ensure completed is a boolean
    ]);

    // Update the task in the database
    $task->update([
        'title' => $request->title,
        'completed' => $request->completed,
    ]);

    // Return the updated task as JSON
    return response()->json($task);
}


public function destroy(Task $task)
{
    // Delete the task
    $task->delete();

    // Return a 204 No Content response
    return response()->json(null, 204);
}

}
