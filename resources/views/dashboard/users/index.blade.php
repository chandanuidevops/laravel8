@extends('dashboard.layout')
@section('content')
<h2>Users Section</h2>
<a href="{{route('users.create')}}" class="btn btn-secondary">Add User</a>
@if (!$users->isEmpty())
    

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Thumbnail</th>
                <th>City</th>
                <th>Country</th>
                <th>Roles</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <?php 
               
                ?>
           
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td><img src="{{asset('storage/'.$user->profile->photo??'NA')}}" alt="" style="width:100px"></td>
                <td>{{$user->profile->city??'NA'}}</td>
                <td>{{$user->profile->country->country??'NA'}}</td>
                <td>@if (!$user->roles->isEmpty())
                    {{$user->roles->implode('name',', ')}}
                @endif
                </td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
               
                <td>
                    <a href="{{route('users.edit',$user->id)}}"  class="btn btn-success">Edit</a>
                    <a href="{{route('users.show',$user->id)}}"  class="btn btn-primary">Show</a>
                    <form action="{{route('users.destroy',$user->id)}}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                    <button type="submit"   class="btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-primary" role="alert">
   No record
</div>
@endif
@endsection