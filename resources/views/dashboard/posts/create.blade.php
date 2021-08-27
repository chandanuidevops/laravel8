@extends('dashboard.layout')
@section('content')
<a href="{{route('categories.index')}}" class="btn btn-secondary">View Posts</a>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <h2>Add Post</h2>
            <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label for="my-input">Post Title</label>
                    <input id="my-input" class="form-control" type="text" name="title" value="{{old('title')}}" >
                    <i class="text-danger">{{ $errors->first('title') }}</i>
                </div>
                <div class="form-group">
                    <label >Content</label>
                    <textarea  class="form-control" type="text" name="content" >
                        {{old('content')}}
                    </textarea>
                    <i class="text-danger">{{ $errors->first('content') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Thumbnail</label>
                    <input class="form-control" type="file" name="thumbnail"  >
                    <i class="text-danger">{{ $errors->first('thumbnail') }}</i>
                </div>
                <div class="form-group">
                    <label for="my-input">Category</label>
                   <select name="category_id[]" class="form-control" multiple >
                       <option value="0">Select  category</option>
                       @if (!$categories->isEmpty())
                           @foreach ($categories as $cats)
                               <option value="{{$cats->id}}">{{$cats->title}}</option>
                           @endforeach
                       @endif
                   </select>
                    <i class="text-danger">{{ $errors->first('category_id') }}</i>
                </div>
                <div class="form-group text-center">
                   
                    <input class="btn btn-primary" type="submit" value="Add New Record">
                </div>
            </form>
        </div>
       
    </div>
</div>

@endsection