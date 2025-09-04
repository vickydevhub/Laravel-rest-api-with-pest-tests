<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
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