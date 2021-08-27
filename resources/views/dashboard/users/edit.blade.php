@extends('dashboard.layout')
@section('content')
<a href="{{route('users.index')}}" class="btn btn-secondary">View User</a>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <h2>Add User</h2>
            <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
               
                <div class="form-group">
                    <label for="my-input">Name</label>
                    <input id="my-input" class="form-control" type="text" name="name" value="{{$user->name}}" >
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Email</label>
                    <input id="my-input" class="form-control" type="email" name="email" value="{{$user->email}}" >
                    <i class="text-danger">{{ $errors->first('email') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Phone</label>
                    <input id="my-input" class="form-control" type="number" name="phone" value="{{$user->profile->phone}}" >
                    <i class="text-danger">{{ $errors->first('email') }}</i>
                </div>
               
                <div class="form-group">
                    <label for="my-input">Country</label>
                   <select name="country" id="" class="form-control">
                       @if (!$countries->isEmpty())
                           @foreach ($countries as $country)
                           <option value="{{$country->id}}" @if($country->id==$user->profile->country->id){{'selected'}}
                           @endif>{{$country->country}}</option>
                           @endforeach
                       @endif
                   </select>
                   <i class="text-danger">{{ $errors->first('country') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">City</label>
                    <input id="my-input" class="form-control" type="text" name="city" value="{{$user->profile->city}}" >
                    <i class="text-danger">{{ $errors->first('city') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Roles</label>
                   <select name="roles[]" multiple id="" class="form-control">
                       @if (!$roles->isEmpty())
                           @foreach ($roles as $role)
                           <option value="{{$role->id}}" @if(in_array($role->id,$user->roles->pluck('id')->toArray())){{'selected'}}
                            @endif>{{$role->name}}</option>
                           @endforeach
                       @endif
                   </select>
                   <i class="text-danger">{{ $errors->first('roles') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Profile</label>
                    <input class="form-control" type="file" name="photo"  >
                    <i class="text-danger">{{ $errors->first('photo') }}</i>
                </div>
                <div class="form-group text-center">
                    <input class="btn btn-primary" type="submit" value="Add New Record">
                </div>
            </form>
        </div>
       
    </div>
</div>

@endsection