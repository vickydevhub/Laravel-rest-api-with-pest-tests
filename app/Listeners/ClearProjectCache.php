<?php

namespace App\Listeners;

use App\Events\ProjectCreated;

class ClearProjectCache
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
        //
    }
}
