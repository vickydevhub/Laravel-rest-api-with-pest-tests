<?php

namespace App\Listeners;

use App\Events\ProjectCreated;
use App\Mail\ProjectCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendProjectCreatedEmail implements ShouldQueue
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
        if ($event->project->user_id === null) {
            return;
        }
        Mail::to($event->project->user->email)
            ->send(new ProjectCreatedMail($event->project));
    }
}
