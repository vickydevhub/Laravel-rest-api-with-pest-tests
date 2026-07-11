<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;

class LogTaskActivity
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
    public function handle(TaskCreated $event)
    {
        Log::info('Task created', [
            'task_id' => $event->task->id,
            'name' => $event->task->name,
            'project_id' => $event->task->project_id,
        ]);
    }
}
