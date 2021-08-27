<?php

// use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/email',function(){
//     return new WelcomeEmail();
// });
Route::get('home/{name}', [WelcomeController::class, 'index']);

// Route::prefix('admin')->middleware(['auth','password.confirm','verified','can:isAllowed,"admin:user"'])->group(function(){
    Route::prefix('admin')->middleware(['auth','password.confirm','verified','check.role:admin,publisher'])->group(function(){
    // Route::prefix('admin')->group(function(){
    Route::view('/','dashboard.admin');
    Route::get('menu',[AdminController::class,'index'])->name('menu');
    Route::resource('posts',PostController::class);
    Route::resource('profiles',UserProfileController::class);
    Route::resource('users',UserController::class);
    Route::resource('pages',PageController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('roles',RoleController::class);
    Route::post('upload',function(){
        $filename=sprintf('tiny_%s.jpg',random_int(1,1000));
        if(request()->hasFile('file')){        
            $filename= request()->file('file')->storeAs('tiny',$filename,'public');
         } else{
            $filename=null;
         }
        if($filename!==null){
            return response()->json(['location'=>asset('storage/'.$filename)],200);
        }else{
            return response()->json(['location'=>'File not uploaded'],200);
        }
        });
});

Auth::routes(['verify'=>true,]);

Route::match(['post','get'],'/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
