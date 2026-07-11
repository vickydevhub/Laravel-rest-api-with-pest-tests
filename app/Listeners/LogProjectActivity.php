<?php

namespace App\Listeners;

use App\Events\ProjectCreated;
use App\Services\AuditLogService;

class LogProjectActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private readonly AuditLogService $auditLogService)
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
        $this->auditLogService->log(
            event: 'project.created',
            model: $event->project,
            newValues: $event->project->toArray(),
        );
    }
}
