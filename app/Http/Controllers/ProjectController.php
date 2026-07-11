<?php

namespace App\Http\Controllers;

use App\DTOs\Project\CreateProjectDTO;
use App\DTOs\Project\UpdateProjectDTO;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService
    ) {}

    /**
     * GET /api/projects
     */
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");

            });

        }

        $projects = $query
            ->latest()
            ->paginate(
                $request->per_page ?? 10
            );

        return response()->json([
            'success' => true,
            'data' => $projects,
        ]);
    }

    /**
     * GET /api/projects/{project}
     */
    public function show(Project $project)
    {
        return response()->json([
            'success' => true,
            'data' => $project,
        ]);
    }

    public function store(StoreProjectRequest $request)
    {

        $dto = CreateProjectDTO::fromArray($request->validated());

        $project = $this->projectService->create($dto);

        return response()->json($project, 201);
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        $dto = UpdateProjectDTO::fromArray($request->validated());

        $project = $this->projectService->update($project, $dto);

        return response()->json($project, 200);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $this->projectService->delete($project);

        return response()->noContent();
    }
}
