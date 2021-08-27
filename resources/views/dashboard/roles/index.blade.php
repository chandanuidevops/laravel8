@extends('dashboard.layout')
@section('content')
<h2>Roles Section</h2>
<a href="{{route('roles.create')}}" class="btn btn-secondary">Add Role</a>
@if (!$roles->isEmpty())
    

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
            @foreach ($roles as $role)
                
           
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->created_at}}</td>
                <td>{{$role->updated_at}}</td>
                <td></td>
                <td>
                    <a href="{{route('roles.edit',$role->id)}}"  class="btn btn-success">Edit</a>
                    <a href="{{route('roles.show',$role->id)}}"  class="btn btn-primary">Show</a>
                    <form action="{{route('roles.destroy',$role->id)}}" method="POST" style="display:inline-block">
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