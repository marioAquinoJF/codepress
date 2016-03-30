@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Create Tag</h3>
    {!! Form::open(['method'=>'post','route'=>['admin.tags.store']]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection
