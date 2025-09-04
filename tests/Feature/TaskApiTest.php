<?php

use App\Models\User;
use App\Models\Project;
use App\Models\Task;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'sanctum');
});

test('a user can create a task for a project', function () {
    $project = Project::factory()->create();

    $data = [
        'name' => 'New Task',
        'description' => 'Task description',
        'status' => 'pending',
        'due_date' => now()->addDays(7)->toDateString(),
    ];

    $response = $this->postJson("/api/projects/{$project->id}/tasks", $data);

    $response->assertStatus(201)
             ->assertJsonFragment(['name' => 'New Task']);

    $this->assertDatabaseHas('tasks', [
        'name' => 'New Task',
        'project_id' => $project->id,
    ]);
});

test('a user can update a task', function () {
    $task = Task::factory()->create();

    $response = $this->putJson("/api/tasks/{$task->id}", [
        'name' => 'Updated Task',
        'description' => 'Updated description',
        'status' => 'in_progress',
        'due_date' => now()->addDays(10)->toDateString(),
    ]);

    $response->assertStatus(200)
             ->assertJsonFragment(['name' => 'Updated Task']);
});

test('a user can delete a task', function () {
    $task = Task::factory()->create();

    $response = $this->deleteJson("/api/tasks/{$task->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

test('a user can assign a task to another user', function () {
    $task = Task::factory()->create();
    $assignee = User::factory()->create();

    $response = $this->postJson("/api/tasks/{$task->id}/assign", [
        'user_id' => $assignee->id,
    ]);

    $response->assertStatus(200)
             ->assertJsonFragment(['assigned_to' => $assignee->id]);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'assigned_to' => $assignee->id,
    ]);
});
