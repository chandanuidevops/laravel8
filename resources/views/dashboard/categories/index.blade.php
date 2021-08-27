@extends('dashboard.layout')
@section('content')
<h2>Category Section</h2>
<a href="{{route('categories.create')}}" class="btn btn-secondary">Add Category</a>
@if (!$categories->isEmpty())
    
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Thumbnail</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Children</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->title}}</td>
                <td> <img src="{{asset('storage/'.$category->thumbnail)}}"
                
                alt="thumbnail" style="max-width:100px"></td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td>
                    @if (!$category->children->isEmpty())
                        @foreach ($category->children as $children)
                        {{$children->title}}
                        @endforeach
                    @endif
                    
                    </td>
                <td>
                    <a href="{{route('categories.edit',$category->id)}}"  class="btn btn-success">Edit</a>
                    <a href="{{route('categories.show',$category->id)}}"  class="btn btn-primary">Show</a>
                    <form action="{{route('categories.destroy',$category->id)}}" method="POST" style="display:inline-block">
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