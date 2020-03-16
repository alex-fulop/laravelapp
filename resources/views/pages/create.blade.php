@extends('layouts.app')

@section('content')

    @if(!isset($post))
        <h1>Create Post</h1>

        {{ Form::open(['action' => ['PostsController@store'], 'method' => 'POST'])}}
            <div class="form-group">
                {{ Form::label('title', 'Title')}}
                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'Body')}}
                {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Your content goes here'])}}
            </div>
            {{-- Creating the Scheduled Section --}}
            <div class="form-group">
                {{ Form::label('schedule','Schedule Post (Year-Month-Date Hr:Min:Sec)')}}
                {{ Form::text('schedule', $current, ['class' => 'form-control', 'placeholder' => 'Insert a date and time (leave blank to post ASAP)'])}}
            </div>

            {{-- Creating the categories Section --}}
            <div class="form-group">
                {{ Form::label('categories', 'Categories:')}}
                {{ Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
            </div>

            <div class="form-group">
                {{ Form::submit('Post', ['class' => 'btn btn-dark']) }}
            </div>

            {{ Form::close()}}



    @else
    <h1>Edit Post</h1>

    {{ Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST'])}}
    {{ Form::hidden('_method', 'PUT')}}
        <div class="form-group">
            {{ Form::label('title', 'Title')}}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Body')}}
            {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Your content goes here'])}}
        </div>

        <div class="form-group">
            {{ Form::label('schedule','Schedule Post (Year-Month-Date Hr:Min:Sec)')}}
            {{ Form::text('schedule', Carbon::now(),['class' => 'form-control', 'placeholder' => 'Insert a date and time (leave blank to post ASAP)'])}}
        </div>

        <div class="form-group">
            {{ Form::submit('Post', '', ['class' => 'btn btn-dark']) }}
        </div>

    {{ Form::close()}}
    @endif
@endsection
