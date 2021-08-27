<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        // dd($role);
        if(!$request->user()->roles->whereIn('name',$role)->first()){
            return redirect()->route('home')->with('status','You are not allowed');
        }
        return $next($request);
    }
}
