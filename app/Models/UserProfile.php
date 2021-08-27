<?php

namespace App\Models;

use User;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country(Type $var = null)
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
    //    public function country(Type $var = null)
    // {
    //     return $this->hasOneThrough(Country::class,UserProfile::class,'country_id','id','country_id','country_id');
    // }
}
