@extends('layouts.app')

@section('content')
    
    <a href="/posts" class="btn btn-primary">Go Back</a>
    <h1>{{$post->title}}</h1>
    
    <div>
        {!!$post->body!!}       {{--  For parsing the html  --}}
    </div>

    <small>Written on {{$post->created_at}}</small>
   
@endsection