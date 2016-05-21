@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h3>Code Category</h3>
    </div>
    <div class="row">
        <a href="/admin/categories/create" class="btn btn-primary">New Category</a>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>    
                    <td>{{$category->name}}</td>    
                    <td>{{$category->parent_id}}</td>    
                    <td>{{$category->active}}</td>    
                    <td>
                        <a class="btn btn-sm btn-primary" href="categories/{{$category->id}}/edit">Edit</a>
                        <a class="btn btn-sm btn-info" href="categories/{{$category->id}}/show">Show</a>
                        <a class="btn btn-sm btn-danger" href="categories/{{$category->id}}/delete">Del</a>
                    </td>                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
