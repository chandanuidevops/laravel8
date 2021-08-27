<?php

namespace App\Providers\App\Listeners;

use App\Events\NewUserRegisterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserProfileListener
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
        //
    }
}
