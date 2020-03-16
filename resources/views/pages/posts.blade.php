@extends('layouts.app')

@section('content')
<div class="card-body">
        <h1>Posts</h1>
        <div class="card-body">
            <a href="pages/create" class="btn btn-dark">Create</a>
        </div>

        {{ Form::open(['action' => ['PostsController@filter'], 'method' => 'GET'])}}
            <div class="form-group">
                {{ Form::label('categories[]', 'Filter by category :')}}
                {{ Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
                <div class="card-body">
                    {{ Form::submit('Filter', ['class'=>'btn btn-dark'])}}
                </div>
            </div>
        {{ Form::close()}}

     </div>
     @if(count($posts) > 0)
     <ul class="list-group">
        @foreach($posts as $post)
            @if($post->scheduled_time <= $post->created_at)
            <li class="list-group-item m-2">
                <h1><a href="/pages/{{$post->id}}">{{$post->title}}</a></h1>
                <small class="d-block">Written By {{$post->user->name}} at : {{$post->created_at}}</small>
                <small>Categories :</small>
                @foreach($post->categories as $category)
                    <small class="btn ml-2">{{$category->name}}</small>
                @endforeach
            </li>
            @endif
        @endforeach
        </ul>
     @else
        <p>No Posts Available</p>
     @endif
@endsection
