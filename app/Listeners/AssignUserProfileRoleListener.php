<?php

namespace App\Listeners;

use App\Events\NewUserRegisterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignUserProfileRoleListener
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
     * @param  NewUserRegisterEvent  $event
     * @return void
     */
    public function handle(NewUserRegisterEvent $event)
    {
        $event->user->roles()->attach(10);
    }
}
