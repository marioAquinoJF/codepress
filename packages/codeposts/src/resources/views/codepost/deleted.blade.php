@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h3>Code Post</h3>
    </div>
    <div class="row">
        <a href="/admin/posts/create" class="btn btn-primary">New Post</a>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>

                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>    
                    <td>{{$post->title}}</td>    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
