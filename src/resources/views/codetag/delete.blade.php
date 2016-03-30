@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Delete Tag</div>
                <div class="panel-body">
                    <ul>
                        <li><strong>Name:</strong> {{$tag->name}}</li>
                    </ul>

                </div>
                <div class="panel-footer">
                    <div class="col-md-offset-10">
                    {!! Form::open(['method'=>'delete','route'=>['admin.tags.delete',$tag->id]]) !!}
                    {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
