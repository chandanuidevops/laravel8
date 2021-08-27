<?php
namespace App\Gates;

use Illuminate\Auth\Access\Response;

class PostGates {
    public function allowed($user,$id){
        return $user->id===$id;
    }

    public function editAction($user,$id)
    {
        $roles = $user->roles->pluck('name')->toArray();
        return $user->id===$id || in_array('admin',$roles) ? Response::allow() : Response::deny('You are not allowed');
    }
}
