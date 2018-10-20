@extends('layouts.app')

@section('content')
    
    <a href="/posts" class="btn btn-primary mb-5">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img src="/storage/cover_images/{{$post->cover_image}}" alt="" width="100%">

    <div class="mt-3">
        {!!$post->body!!}       {{--  For parsing the html  --}}
    </div>

    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
   
    <hr>
    @if (!Auth::guest())    {{--  If person is guest dont show him edit del btn  --}}

        @if(Auth::user()->id == $post->user_id) {{--If post is created by that person show him--}}

            {{--  EDIT BTN  --}}
            <a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a>   
            
            {{--  FOR THE DELETE FUNCTIONALITY  --}}
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}

                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}

            {!!Form::close()!!}

        @endif    
     @endif
@endsection