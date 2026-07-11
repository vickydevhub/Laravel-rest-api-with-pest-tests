<?php

namespace App\Services;

use App\DTOs\Project\CreateProjectDTO;
use App\DTOs\Project\UpdateProjectDTO;
use App\Models\Project;

class ProjectService
{
    public function create(CreateProjectDTO $dto): Project
    {
        return Project::create($dto->toArray());
    }

    public function update(Project $project, UpdateProjectDTO $dto): Project
    {
        $project->update($dto->toArray());

        return $project->refresh();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
