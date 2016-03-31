@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Edit Tag</h3>
    {!! Form::open(['method'=>'put','route'=>['admin.tags.update',$tag->id]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $tag->name, ['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection
