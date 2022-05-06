<?php

namespace App\Listeners;

use App\Events\PersonCapturedEvent;
use App\Mail\PersonCaptured;
use App\Models\People\Person;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyPersonCaptured implements ShouldQueue
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
     */
    public function handle(PersonCapturedEvent $event)
    {
        Mail::to($event->person->email)->send(new PersonCaptured($event->person));
    }
}
