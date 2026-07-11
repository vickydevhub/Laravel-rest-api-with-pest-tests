<?php

namespace App\Providers;

use App\Events\ProjectCreated;
use App\Events\ProjectDeleted;
use App\Events\ProjectUpdated;
use App\Events\TaskCompleted;
use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use App\Listeners\RecordAuditLog;
use App\Listeners\SendProjectCreatedEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProjectCreated::class => [
            RecordAuditLog::class,
            SendProjectCreatedEmail::class,
        ],

        ProjectUpdated::class => [
            RecordAuditLog::class,
        ],

        ProjectDeleted::class => [
            RecordAuditLog::class,
        ],

        TaskCreated::class => [
            RecordAuditLog::class,
        ],

        TaskUpdated::class => [
            RecordAuditLog::class,
        ],

        TaskDeleted::class => [
            RecordAuditLog::class,
        ],

        TaskCompleted::class => [
            RecordAuditLog::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
