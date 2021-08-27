<?php

namespace App\Listeners;

use App\Models\UserProfile;
use App\Events\NewUserRegisterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $userProfile = new UserProfile(['user_id'=>$event->user->id,'country_id'=>1,'city'=>'Bangalore','phone'=>9988998899]);
        $event->user->profile()->save($userProfile);
    }
}
