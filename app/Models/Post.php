<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $table='posts';
    // protected $primaryKey = 'title';
    
  public function user()
  {
    return $this->belongsTo(User::class,'user_id','id');
  }
  public function profile()
  {
     return $this->hasOneThrough(UserProfile::class,User::class,'id','user_id','user_id','id');
  }
  // public function categories()
  // {
  //   return $this->belongsTo(Category::class);
  // }
  public function categories(Type $var = null)
  {
     return $this->belongsToMany(Category::class,'categories_posts','post_id','category_id','id','id');
  }
  public function setSlugAttribute($title)
  {
    $slug = trim(preg_replace("/[^\w\d]+/i","-",$title),"-");
    $count = Post::where('slug','like',"%${slug}%" )->count();
   
   if($count>0){
    $slug=$slug."-".($count+1);
   }
   $this->attributes['slug']=strtolower($slug);
  } 
  public function getSlugAttribute($title)
  {
   if($title==null){
     return $this->id;
   }else{
     return $title;
   }
  }
}
