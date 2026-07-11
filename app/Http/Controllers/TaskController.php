<?php

namespace App\Http\Controllers;

use App\DTOs\Task\CreateTaskDTO;
use App\DTOs\Task\UpdateTaskDTO;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    public function index($projectId)
    {
        $tasks = Task::where('project_id', $projectId)->get();

        return response()->json($tasks, 200);
    }

    public function store(StoreTaskRequest $request, $projectId)
    {
        $validated = array_merge(
            $request->validated(),
            ['project_id' => (int) $projectId]
        );

        $dto = CreateTaskDTO::fromArray($validated);

        $task = $this->taskService->create($dto);

        return response()->json($task, 201);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $dto = UpdateTaskDTO::fromArray($request->validated());

        $this->taskService->update($task, $dto);

        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $this->taskService->delete($task);

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

    public function show(Task $task)
    {
        return response()->json([
            'success' => true,
            'data' => $task,
        ]);
    }
}
