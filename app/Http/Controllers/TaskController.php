<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
  public function index($projectId)
  {
    $tasks = Task::where('project_id', $projectId)->get();

    return response()->json($tasks, 200);
  }

  public function store(Request $request, $projectId)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
      'status' => 'required|string|in:pending,in-progress,completed',
      'due_date' => 'nullable|date',
    ]);

    $validated['project_id'] = $projectId;

    $task = Task::create($validated);

    return response()->json($task, 201);
  }

  public function update(Request $request, $id)
  {
    $task = Task::findOrFail($id);

    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
      'status' => 'required|string|in:pending,in_progress,completed',
      'due_date' => 'nullable|date',
    ]);

    $task->update($validated);

    return response()->json($task, 200);
  }

  public function destroy($id)
  {
    $task = Task::findOrFail($id);
    $task->delete();

    return response()->noContent();
  }

  public function assign(Request $request, $id)
  {
    $task = Task::findOrFail($id);

    $validated = $request->validate([
      'user_id' => 'required|exists:users,id',
    ]);

    $task->assigned_to = $validated['user_id'];
    $task->save();

    return response()->json($task, 200); // no eager load
  }
}