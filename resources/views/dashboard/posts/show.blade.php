@extends('dashboard.layout')
@section('content')
<h2>Roles Section</h2>
<a href="{{route('roles.create')}}" class="btn btn-secondary">Add Role</a>
<a href="{{route('roles.index')}}" class="btn btn-secondary">All Roles</a>
@if ($category->exists())
    

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
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td></td>
                <td>
                    <a href="{{route('categories.edit',$category->id)}}"  class="btn btn-success">Edit</a>
                    <form action="{{route('categories.destroy',$role->id)}}" method="POST" style="display:inline-block">
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