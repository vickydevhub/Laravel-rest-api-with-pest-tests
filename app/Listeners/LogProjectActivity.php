<?php

namespace App\Listeners;

use App\Events\ProjectCreated;
use Illuminate\Support\Facades\Log;

class LogProjectActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ProjectCreated $event)
    {
        Log::info('Project created', [
            'project_id' => $event->project->id,
            'project_name' => $event->project->name,
            // 'user_id' => $event->project->user_id,
        ]);
    }
}
