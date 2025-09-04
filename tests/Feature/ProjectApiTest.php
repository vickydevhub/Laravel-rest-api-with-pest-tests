<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use App\Models\User;
use App\Models\Project;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'sanctum');
});

test('a user can create a project', function () {
    $data = [
        'name' => 'My Project',
        'description' => 'Test description'
    ];

    $response = $this->postJson('/api/projects', $data);

    $response->assertStatus(201)
             ->assertJsonFragment(['name' => 'My Project']);
});

test('a user can update a project', function () {
    $project = Project::factory()->create();

    $response = $this->putJson("/api/projects/{$project->id}", [
        'name' => 'Updated Project',
        'description' => 'Updated description'
    ]);

    $response->assertStatus(200)
             ->assertJsonFragment(['name' => 'Updated Project']);
});

test('a user can delete a project', function () {
    $project = Project::factory()->create();

    $response = $this->deleteJson("/api/projects/{$project->id}");

    $response->assertStatus(204);
});
