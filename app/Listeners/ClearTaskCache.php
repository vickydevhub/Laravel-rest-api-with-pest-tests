<?php

namespace App\Listeners;

use App\Events\TaskCreated;

class ClearTaskCache
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
        //
    }
}
