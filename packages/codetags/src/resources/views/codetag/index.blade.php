@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h3>Code Tag</h3>
    </div>
    <div class="row">
        <a href="/admin/tags/create" class="btn btn-primary">New Tag</a>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td>{{$tag->id}}</td>    
                    <td>{{$tag->name}}</td>   
                    <td>
                        <a class="btn btn-sm btn-primary" href="tags/{{$tag->id}}/edit">Edit</a>
                        <a class="btn btn-sm btn-info" href="tags/{{$tag->id}}/show">Show</a>
                        <a class="btn btn-sm btn-danger" href="tags/{{$tag->id}}/delete">Del</a>
                    </td>                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
