<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;

use App\Models\UserProfile;
use App\Scopes\VerifiedUsers;
use App\Scopes\NotVerifiedUsers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'token',
        // 'secret'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //example of global scope
    // public static function boot()
    // {
    //     parent::boot();
    //     static::addGLobalScope(new VerifiedUsers);
    //     static::addGLobalScope(new NotVerifiedUsers);
    // }
    //example of local scope
    public function scopeVfu($query){
        return $query->where('email_verified_at','<>',null);
    }
    public function scopeNvfu($query){
        return $query->where('email_verified_at','=',null);
    }
    public function scopeFindById($query , $id)
    {
        return $query->where('id',$id);
    }
    public function profile()
    {
        return $this->hasOne(UserProfile::class,'user_id','id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'user_id','id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id','id');
    }
    public function setUsernameAttribute($username){
        $username = trim(preg_replace("/[^\w\d]+/i","",$username),"");
            $count = User::where('username','like',"%${username}%" )->count();
        
        if($count>0){
            $username=$username."-".($count+1);
        }
        $this->attributes['username']=strtolower($username);
    }
}
