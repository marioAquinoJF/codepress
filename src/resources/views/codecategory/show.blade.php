@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Show Category</div>
                <div class="panel-body">
                    <ul>
                        <li><strong>Name:</strong> {{$category->name}}</li>
                        <li><strong>Active:</strong> {{$category->active}}</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
