@extends('layouts.app')

@section('content')
<div class="card-body">
        <h1>Posts</h1>
         <a href="pages/create" class="btn btn-dark">Create</a>
     </div>
     @if(count($posts) > 0)
     <ul class="list-group">
        @foreach($posts as $post)
            <li class="list-group-item m-2">
                <h1><a href="/pages/{{$post->id}}">{{$post->title}}</a></h1>
                <small>Written By {{$post->user->name}} at : {{$post->created_at}}</small>
            </li>
        @endforeach
        </ul>
     @else
        <p>No Posts Available</p>
     @endif
@endsection
