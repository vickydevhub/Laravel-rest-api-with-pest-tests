<?php

namespace App\Listeners;

use App\Events\ProjectCreated;
use App\Events\ProjectDeleted;
use App\Events\ProjectUpdated;
use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use Illuminate\Support\Facades\Cache;

class ClearCache
{
    public function handle(object $event): void
    {
        match (true) {

            $event instanceof ProjectCreated,
            $event instanceof ProjectUpdated,
            $event instanceof ProjectDeleted => [

                Cache::forget('projects.all'),

                Cache::forget("projects.{$event->project->id}"),
            ],

            $event instanceof TaskCreated,
            $event instanceof TaskUpdated,
            $event instanceof TaskDeleted => [

                Cache::forget('tasks.all'),

                Cache::forget("tasks.{$event->task->id}"),
            ],

            default => null,
        };
    }
}
