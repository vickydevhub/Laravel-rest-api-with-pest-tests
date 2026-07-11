<?php

namespace App\Services;

use App\DTOs\Task\CreateTaskDTO;
use App\DTOs\Task\UpdateTaskDTO;
use App\Models\Task;

class TaskService
{
    public function create(CreateTaskDTO $dto): Task
    {
        return Task::create($dto->toArray());
    }

    public function update(Task $task, UpdateTaskDTO $dto): Task
    {
        $task->update($dto->toArray());

        return $task->refresh();
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}
