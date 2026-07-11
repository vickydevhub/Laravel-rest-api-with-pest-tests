<?php

namespace App\Services;

use App\DTOs\Project\CreateProjectDTO;
use App\DTOs\Project\UpdateProjectDTO;
use App\Events\ProjectCreated;
use App\Events\ProjectDeleted;
use App\Events\ProjectUpdated;
use App\Models\Project;

class ProjectService
{
    public function create(CreateProjectDTO $dto): Project
    {
        $project = Project::create($dto->toArray());

        ProjectCreated::dispatch($project);

        return $project;
    }

    public function update(Project $project, UpdateProjectDTO $dto): Project
    {
        $oldValues = $project->getOriginal();

        $project->update($dto->toArray());

        $project->refresh();

        ProjectUpdated::dispatch(
            $project,
            $oldValues,
            $project->toArray(),
        );

        return $project;
    }

    public function delete(Project $project): void
    {
        ProjectDeleted::dispatch(
            $project,
            $project->toArray(),
        );

        $project->delete();
    }
}
