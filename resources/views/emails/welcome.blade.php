@component('mail::message')
# Welcome to our website

The body of your message.

@foreach ($posts as $post)
<li><a href="{{route('posts.show',$post->slug)}}" >{{$post->title}}</a> </li>

@endforeach


@component('mail::button', ['url' => route('posts.index')])
view  All posts
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
