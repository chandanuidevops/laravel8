@extends('dashboard.layout')
@section('content')
<a href="{{route('categories.index')}}" class="btn btn-secondary">View Category</a>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <h2>Add Category</h2>
           
            <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="my-input">Category Title</label>
                    <input id="my-input" class="form-control" type="text" name="title" value="{{$category->title}}" >
                    <i class="text-danger">{{ $errors->first('title') }}</i>
                </div>
                <div class="form-group">
                    <label >Content</label>
                    <textarea  class="form-control" type="text" name="content" >
                       {!! $category->content !!}
                    </textarea>
                    <i class="text-danger">{{ $errors->first('content') }}</i>
                </div>
                <div class="form-group">
                   <img src="{{asset('storage/'.$category->thumbnail)}}" alt="" style="max-width:100px">
                </div>
                <div class="form-group">
                    <label for="my-input">Thumbnail</label>
                    <input class="form-control" type="file" name="thumbnail"  >
                    <i class="text-danger">{{ $errors->first('thumbnail') }}</i>
                </div>
                <div class="form-group">
                   
                   <select name="parent_id" class="form-control">
                       <option value="0">Select a parent category</option>
                       @if (!$categories->isEmpty())
                           @foreach ($categories as $cats)
                           
                               <option value="{{$cats->id}}"  @if ($cats->id==$category->parent->id){{'selected'}}
                                   
                               @endif>{{$cats->title}}</option>
                           @endforeach
                       @endif
                   </select>
                    <i class="text-danger">{{ $errors->first('parent_id') }}</i>
                </div>
                <div class="form-group text-center">
                   
                    <input class="btn btn-primary" type="submit" value="Add New Record">
                </div>
            </form>
        </div>
       
    </div>
</div>

@endsection