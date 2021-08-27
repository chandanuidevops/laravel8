<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function isAllowed(User $user, Post $post){
        return $user->id===$post->user_id;
    }

    public function allowEdit(User $user, Post $post)
    {
        $roles = $user->roles->pluck('name')->toArray();
        return $user->id===$post->user_id || in_array('admin',$roles) ? Response::allow() : Response::deny('You are not allowed');
    }
}
