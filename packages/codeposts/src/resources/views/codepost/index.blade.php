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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>    
                    <td><a href="posts/{{$post->id}}/show">{{$post->title}}</a></td>    
                    <td>
                        <a name='link_edit_post_{{$post->id}}' class="btn btn-sm btn-primary" href="posts/{{$post->id}}/edit">Edit</a>
                        <a class="btn btn-sm btn-info" href="posts/{{$post->id}}/show">Show</a>
                        <a class="btn btn-sm btn-danger" href="posts/{{$post->id}}/delete">Del</a>
                    </td>                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
