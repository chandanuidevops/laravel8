    {{-- @extends('layouts.posts')
    @section('title', 'Create new posts')
    @yield('name')
    @section('content')
    <form action="{{ route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" value="{{old('name')}}">
        {{$errors->first('name')}}
        <br>
        <textarea name="message" id="" ></textarea>
        {{$errors->first('message')}}
        <br>
        <input type="file" name="photo">
        {{$errors->first('photo')}}
        <br>
        <label for="">Terms</label>
        <input type="checkbox" name="tos" >
        {{$errors->first('tos')}}
        <br>
        <input type="url" name="web" id="">
        {{$errors->first('web')}}
        <input type="submit" value="Submit">
    </form>
    @endsection --}}
    