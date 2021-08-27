@extends('dashboard.layout')
@section('content')
<a href="{{route('users.index')}}" class="btn btn-secondary">View User</a>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <h2>Add User</h2>
            <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="my-input">Username</label>
                    <input id="my-input" class="form-control" type="text" name="username" value="{{old('username')}}" >
                    <i class="text-danger">{{ $errors->first('username') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Name</label>
                    <input id="my-input" class="form-control" type="text" name="name" value="{{old('name')}}" >
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Email</label>
                    <input id="my-input" class="form-control" type="email" name="email" value="{{old('email')}}" >
                    <i class="text-danger">{{ $errors->first('email') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Phone</label>
                    <input id="my-input" class="form-control" type="number" name="phone" value="{{old('phone')}}" >
                    <i class="text-danger">{{ $errors->first('email') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Password</label>
                    <input id="my-input" class="form-control" type="password" name="password" value="{{old('password')}}" >
                    <i class="text-danger">{{ $errors->first('password') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Country</label>
                   <select name="country" id="" class="form-control">
                       @if (!$countries->isEmpty())
                           @foreach ($countries as $country)
                           <option value="{{$country->id}}">{{$country->country}}</option>
                           @endforeach
                       @endif
                   </select>
                   <i class="text-danger">{{ $errors->first('country') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">City</label>
                    <input id="my-input" class="form-control" type="text" name="city" value="{{old('city')}}" >
                    <i class="text-danger">{{ $errors->first('city') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Roles</label>
                   <select name="roles[]" multiple id="" class="form-control">
                       @if (!$roles->isEmpty())
                           @foreach ($roles as $role)
                           <option value="{{$role->id}}">{{$role->name}}</option>
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