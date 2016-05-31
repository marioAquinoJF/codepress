@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Edit Post</h3>
    {!! Form::open(['method'=>'put','route'=>['admin.posts.update',$post->id]]) !!}
    <div class="form-group">
        {!! Form::label('title', 'Título:') !!}
        {!! Form::text('title', $post->title, ['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('content', 'Content:') !!}
        {{-- Form::textarea('content', $post->content, ['class'=> 'form-control']) --}}
        <textarea name="content" id='mytiny'>{{$post->content}}</textarea>
        @include('tinymce::tpl')
    </div>
    <div class="form-group">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection
