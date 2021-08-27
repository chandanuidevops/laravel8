@extends('dashboard.layout')
@section('content')
<h2>Posts Section</h2>
<a href="{{route('posts.create')}}" class="btn btn-secondary">Add Post</a>
@if (!$posts->isEmpty())
    
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Thumbnail</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td> {{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td> <img src="{{asset('storage/'.$post->thumbnail)}}"
                
                alt="thumbnail" style="max-width:100px"></td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td>
                @if (!$post->categories->isEmpty())
                    @foreach ($post->categories as $cat)
                    {{$cat->title}}
                    @endforeach
                @endif
                </td>
                <td>
                    {{-- for gate --}}
                    {{-- @can('isAllowed',$post->user->id) --}}

                    {{-- for policy --}}
                     @can('viewAny',$post)
                    <a href="{{route('posts.edit',$post->id)}}"  class="btn btn-success">Edit</a>
                    <form action="{{route('posts.destroy',$post->id)}}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                    <button type="submit"   class="btn btn-danger">Delete</button>
                </form>
                    @endcan
                   
                    <a href="{{route('posts.show',$post->id)}}"  class="btn btn-primary">Show</a>
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$posts->onEachSide(2)->links()}}
</div>
@else
<div class="alert alert-primary" role="alert">
   No record
</div>
@endif
@endsection