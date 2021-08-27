<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Session;
use URL;
use Session;
class WelcomeController extends Controller
{
    public function index($name='')
    {
        $user = \App\Models\User::find(30);
        dd(URL::signedRoute('users.index',['user'=>$user]));
        // $posts =  new Post();
        // $data =   $posts->data();
        // $data = session()->all();
      
        Session::put(['user_name'=>'Chandana singh']);
        // Session::push('user_name', 'developers');
        // dd(session('user_name'));
        session()->flash('status', 'Task was successful!');
        return view('welcome');
    }
}