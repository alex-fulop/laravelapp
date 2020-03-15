@extends('layouts.app')

@section('content')
    <div class="jumbotron rounded-0">
        {{-- Main Section --}}
        <a href="/pages" class="btn btn-light">Go back</a>
        <p class="display-4">
            {{$post->title}}
        </p>
        <small>By: {{$post->user->name}}</small>
        <p>{{$post->body}}</p>

        {{-- Options --}}
        @if(!Auth::guest() && $post->user_id == auth()->user()->id)
        <div class="row card-body">
            <a href="/pages/{{$post->id}}/edit" class="btn btn-dark mr-2">Edit</a>
            {{ Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])}}
                {{ Form::hidden('_method', 'DELETE')}}
                {{ Form::Submit('Delete', ['class' => 'btn btn-danger'])}}
            {{ Form::close()}}
        </div>
        @endif
    </div>

    <div class="card-body">

        {{-- Comment Section --}}
        {{ Form::open(['action' => ['CommentsController@store', $post->id], 'method' => 'GET'])}}
        <div class="card-body">
            <div class="form-group">
                {{Form::label('body','Comment')}}
                {{Form::text('body', '', ['class' => 'form-control'])}}
            </div>
            {{ Form::submit('Post', ['class' => 'btn btn-dark'])}}
        </div>
        {{ Form::close()}}
        <p>Comment Section</p>
        <hr>
        @if(count($comments) > 0)
        <ul class="list-group">
            @foreach($comments as $comment)
                <li class="list-group-item">
                    <p>{{$comment->body}}</p>
                    <small>Commented by : {{$comment->user->name}}</small>
                </li>
                @if(!Auth::guest() && $comment->user_id == Auth()->user()->id)
                <div class="card-body row">
                    <a href="/comments/{{$comment->id}}/edit" class="btn btn-dark mr-2">Edit</a>
                    {{ Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST'])}}
                        {{ Form::hidden('_method', 'DELETE')}}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {{ Form::close()}}
                </div>
                @endif

            @endforeach
        </ul>
        @else
         <p>This post has no comments.</p>
        @endif
    </div>
    @endsection
