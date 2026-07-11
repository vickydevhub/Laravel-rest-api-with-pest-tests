<?php

namespace App\Services;

use App\DTOs\Task\CreateTaskDTO;
use App\DTOs\Task\UpdateTaskDTO;
use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use App\Models\Task;

class TaskService
{
    public function create(CreateTaskDTO $dto): Task
    {
        $task = Task::create($dto->toArray());

        TaskCreated::dispatch($task);

        return $task;
    }

    public function update(Task $task, UpdateTaskDTO $dto): Task
    {
        $task->update($dto->toArray());

        $task->refresh();

        TaskUpdated::dispatch($task);

        return $task;
    }

    public function delete(Task $task): void
    {
        TaskDeleted::dispatch($task);

        $task->delete();
    }
}
