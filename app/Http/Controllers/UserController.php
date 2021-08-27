<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Country;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!request()->hasValidSignature()){
        //     abort(401);
        // }
        $users= User::with('roles','profile')->get();
       
        return view('dashboard.users.index',compact('users'));
    }
     /**
     * login by api token
     *
     */
    public function login(Request $request)
    {
        
        $user =User::where("username",$request->username)->first();
        if(!$user || hash::check($request->password,$user->password)){
            return response([
                'message'=>['These credential do not match']
            ],404);
            $token = createToken('token')->plainTextToken;
            $response = [
                'user'=>$user,
                'token'=>$token
            ];
            return response($response,200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        $countries=Country::all();
        return view('dashboard.users.create',compact('roles','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        
     
        
       $request->validated();
      
        $user=[
            'username'=>$request->username,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->username),
        ];
       
        $user= User::create($user);
        
      
        
        $filename=sprintf('thumbnail_%s.jpg',random_int(1,1000));
        if($request->hasFile('photo')){
            $filename=$request->file('photo')->storeAs('profiles',$filename,'public');
        }else{
            $filename='profiles/dummy.jpg';
        }
        if($user){
            $profile =new UserProfile(
                [
                    'user_id'=>$user->id,
                    'city'=>$request->city,
                    'country_id'=>$request->country,
                    'photo'=> $filename,
                    'phone'=> $request->phone,
                ]
                );
                $user->profile()->save($profile);
                $user->roles()->attach($request->roles);
                return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('profile','roles')->where('id',$id)->first();
        return view('dashboard.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with(['profile','roles'])->where('id',$id)->first();
        // dd($user);
       $countries=Country::all();
       $roles= Role::all();
        return view('dashboard.users.edit',compact('user','roles','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $filename=sprintf('thumbnail_%s.jpg',random_int(1,1000));
        if($request->hasFile('photo')){
            $filename=$request->file('photo')->storeAs('profiles',$filename,'public');
        }else{
            $filename=$user->profile->photo;
        }
        $save= $user->save();
        if($save){
            $profile=
                [
                    'city'=>$request->city,
                    'country_id'=>$request->country,
                    'photo'=> $filename,
                    'phone'=> $request->phone,
                ];
             
                $user->profile()->update($profile);
                $user->roles()->sync($request->roles);
                return redirect()->route('users.index');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
       UserProfile::where('user_id',$user->id)->delete();
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index');
    }
}
