<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Harimayco\Menu\Facades\Menu;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
       
        if($request->isMethod('post')){
            $token = Str::random(80);
            $user = $request->user();
            $user->token = $token;
            $user->secret  = Crypt::encryptString($request->secret);
            $user->save();
            return redirect('/home');
        }
        try {
            $decrypted = Crypt::decryptString(auth()->user()->secret);
        } catch (Throwable $exception) {

            $decrypted='N/A or modified';
        }
        $public_menu = Menu::getByName('default-menu'); //return array
       
        return view('home',compact('decrypted','public_menu'));
    }
}
