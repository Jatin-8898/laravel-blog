@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data']
                    ) !!}
    
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Enter the Title']) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', $post->body, ['id'=>'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Enter the Post Content']) }}
    </div>
    
     <div class="form-group">
        {{ Form::file('cover_image') }}
    </div>

    {{--  For spoofing the put req laravel allows us to do so coz our edit works on PUT req --}}
    {{Form::hidden('_method', 'PUT')}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    
    {!! Form::close() !!}
@endsection