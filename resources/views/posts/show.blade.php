@extends('layouts.app')

@section('content')
    
    <a href="/posts" class="btn btn-primary mb-5">Go Back</a>
    <h1>{{$post->title}}</h1>
    
    <div>
        {!!$post->body!!}       {{--  For parsing the html  --}}
    </div>

    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
   
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a>   
    
    {{--  FOR THE DELETE FUNCTIONALITY  --}}

    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}

        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}

    {!!Form::close()!!}

@endsection