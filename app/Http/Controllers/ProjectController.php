<?php

namespace App\Http\Controllers;

use App\DTOs\Project\CreateProjectDTO;
use App\DTOs\Project\UpdateProjectDTO;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
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

        $project = Project::create($dto->toArray());

        return response()->json($project, 201);
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        $dto = UpdateProjectDTO::fromArray($request->validated());

        $project->update($dto->toArray());

        return response()->json($project, 200);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->noContent();
    }
}
