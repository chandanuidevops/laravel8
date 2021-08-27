<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */ 
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate::define('isAllowed',function($user, $post){
        //     // $allowed=explode(':',$post);
        //     // $roles = $user->roles->pluck('name')->toArray();
        //     // return array_intersect($allowed, $roles);
        //     return $user->id===$post;
        // });
        
        // Gate::define('isUser',function($user){
        //     $roles = $user->roles->pluck('name')->toArray();
        //     return in_array('User',$roles);
        // });

        // Gate::define('isAllowed','App\Gates\PostGates@allowed');
        // Gate::define('allow-edit','App\Gates\PostGates@editAction');
    }
}
