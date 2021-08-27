@extends('dashboard.layout')
@section('content')
<a href="{{route('roles.index')}}" class="btn btn-secondary">View Role</a>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <h2>Add Roles</h2>
            <form action="{{route('roles.store')}}" method="post" >
                @csrf
                <div class="form-group">
                    <label for="my-input">Role Name</label>
                    <input id="my-input" class="form-control" type="text" name="name" value="{{old('name')}}" >
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                <div class="form-group text-center">
                   
                    <input class="btn btn-primary" type="submit" value="Add New Record">
                </div>
            </form>
        </div>
       
    </div>
</div>

@endsection