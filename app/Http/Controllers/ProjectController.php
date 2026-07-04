<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

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

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
    ]);

    $project = Project::create($validated);

    return response()->json($project, 201);
  }

  public function update(Request $request, $id)
  {
    $project = Project::findOrFail($id);

    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
    ]);

    $project->update($validated);

    return response()->json($project, 200);
  }

  public function destroy($id)
  {
    $project = Project::findOrFail($id);
    $project->delete();

    return response()->noContent();
  }
}