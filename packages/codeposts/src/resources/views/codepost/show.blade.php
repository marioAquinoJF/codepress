@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{$post->title}}</h1>
            {!! $post->content !!}
            <div class="panel panel-default">
                <div class="panel-heading">Comentários <span style="float: right;">Novo</span></div>
                <div class="panel-body">
                    @if(count($comments) > 0)
                    @foreach($comment as $comments)
                    <p>{{ $comments }}</p>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
