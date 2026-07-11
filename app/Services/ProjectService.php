<?php

namespace App\Services;

use App\DTOs\Project\CreateProjectDTO;
use App\DTOs\Project\UpdateProjectDTO;
use App\Events\ProjectCreated;
use App\Events\ProjectDeleted;
use App\Events\ProjectUpdated;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ProjectService
{
    public function getAll(Request $request): LengthAwarePaginator
    {
        $search = $request->input('search');
        $perPage = (int) $request->input('per_page', 10);
        $page = (int) $request->input('page', 1);

        $cacheKey = sprintf(
            'projects.index.search:%s.per_page:%d.page:%d',
            $search ?? 'all',
            $perPage,
            $page
        );

        return Cache::remember(
            $cacheKey,
            now()->addMinutes(10),
            function () use ($search, $perPage) {

                $query = Project::query();

                if ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    });
                }

                return $query
                    ->latest()
                    ->paginate($perPage);
            }
        );
    }

    public function getById(Project $project): Project
    {
        return Cache::remember(
            "projects.{$project->id}",
            now()->addMinutes(10),
            fn () => $project->fresh()
        );
    }

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
