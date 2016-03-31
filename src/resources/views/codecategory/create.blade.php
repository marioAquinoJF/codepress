@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Create Category</h3>
    {!! Form::open(['method'=>'post','route'=>['admin.categories.store']]) !!}
    <div class="form-group">
        {!! Form::label('parent', 'Parent:') !!}
        {!! Form::select('parent_id', $categories, null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('active', 'Active:') !!}
        {!! Form::checkbox('active', null, ['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection
