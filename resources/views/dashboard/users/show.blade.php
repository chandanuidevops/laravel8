@extends('dashboard.layout')
@section('content')
<h2>User Section</h2>
<a href="{{route('users.create')}}" class="btn btn-secondary">Add User</a>
<a href="{{route('users.index')}}" class="btn btn-secondary">All User</a>
@if ($user->exists())
    

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Users</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td></td>
                <td>
                    <a href="{{route('users.edit',$user->id)}}"  class="btn btn-success">Edit</a>
                    <form action="{{route('users.destroy',$user->id)}}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                    <button type="submit"   class="btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
          
        </tbody>
    </table>
</div>
@else
<div class="alert alert-primary" role="alert">
   No record
</div>
@endif
@endsection