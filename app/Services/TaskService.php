<?php

namespace App\Services;

use App\DTOs\Task\CreateTaskDTO;
use App\DTOs\Task\UpdateTaskDTO;
use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class TaskService
{
    public function getAll(): Collection
    {
        return Cache::remember(
            'tasks.all',
            now()->addMinutes(10),
            fn () => Task::all()
        );
    }

    public function getById(Task $task): Task
    {
        return Cache::remember(
            "tasks.{$task->id}",
            now()->addMinutes(10),
            fn () => $task
        );
    }

    public function create(CreateTaskDTO $dto): Task
    {
        $task = Task::create($dto->toArray());

        TaskCreated::dispatch($task);

        return $task;
    }

    public function update(Task $task, UpdateTaskDTO $dto): Task
    {
        $oldValues = $task->getOriginal();

        $task->update($dto->toArray());

        $task->refresh();

        TaskUpdated::dispatch(
            $task,
            $oldValues,
            $task->toArray(),
        );

        return $task;
    }

    public function delete(Task $task): void
    {
        TaskDeleted::dispatch(
            $task,
            $task->toArray(),
        );

        $task->delete();
    }
}
