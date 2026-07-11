<?php

namespace App\Listeners;

use App\Events\ProjectCreated;
use App\Events\ProjectDeleted;
use App\Events\ProjectUpdated;
use App\Events\TaskCompleted;
use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use App\Services\AuditLogService;

class RecordAuditLog
{
    public function __construct(
        private readonly AuditLogService $auditLogService,
    ) {}

    public function handle(object $event): void
    {
        match (true) {

            $event instanceof ProjectCreated => $this->auditLogService->log(
                'project.created',
                $event->project,
                null,
                $event->project->toArray()
            ),

            $event instanceof ProjectUpdated => $this->auditLogService->log(
                'project.updated',
                $event->project,
                $event->oldValues,
                $event->newValues
            ),

            $event instanceof ProjectDeleted => $this->auditLogService->log(
                'project.deleted',
                $event->project,
                $event->oldValues,
                null
            ),

            $event instanceof TaskCreated => $this->auditLogService->log(
                'task.created',
                $event->task,
                null,
                $event->task->toArray()
            ),

            $event instanceof TaskUpdated => $this->auditLogService->log(
                'task.updated',
                $event->task,
                $event->oldValues,
                $event->newValues
            ),

            $event instanceof TaskDeleted => $this->auditLogService->log(
                'task.deleted',
                $event->task,
                $event->oldValues,
                null
            ),

            $event instanceof TaskCompleted => $this->auditLogService->log(
                'task.completed',
                $event->task,
                null,
                $event->task->toArray()
            ),

            default => null,
        };
    }
}
