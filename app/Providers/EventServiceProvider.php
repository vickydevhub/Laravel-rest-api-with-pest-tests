<?php

namespace App\Providers;

use App\Events\ProjectCreated;
use App\Events\TaskCreated;
use App\Listeners\ClearProjectCache;
use App\Listeners\ClearTaskCache;
use App\Listeners\LogProjectActivity;
use App\Listeners\LogTaskActivity;
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
            LogProjectActivity::class,
            ClearProjectCache::class,
        ],

        TaskCreated::class => [
            LogTaskActivity::class,
            ClearTaskCache::class,
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
