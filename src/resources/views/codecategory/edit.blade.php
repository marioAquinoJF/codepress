@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Edit Category</h3>
    {!! Form::open(['method'=>'put','route'=>['admin.categories.update',$category->id]]) !!}
    <div class="form-group">
        {!! Form::label('parent_id', 'Parent:') !!}
        {!! Form::select('parent_id', $categories, $category->parent_id,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $category->name, ['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('active', 'Active:') !!}
        {!! Form::checkbox('active', $category->active, ['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection
