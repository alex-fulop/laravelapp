@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/posts/create" class="btn btn-dark">Create Post</a>
                        {{-- Your Posts Section --}}
                        <h3>Your Posts</h3>
                        @if(count($posts) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Post</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>
                                                <a href="/pages/{{$post->id}}">
                                                    {{$post->title}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="/pages/{{$post->id}}/edit" class="btn btn-dark">
                                                    Edit
                                                </a>
                                            </td>

                                            <td>
                                                {{ Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])}}
                                                    {{ Form::hidden('_method', 'DELETE')}}
                                                    {{ Form::Submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {{ Form::close()}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                        <p>You don't currenty have any posts, go <a href="/pages/create">create</a>one. </p>
                        @endif

                            {{-- Scheduled posts Section --}}
                            @if(count($scheduledPosts) > 0)
                                <h3>Scheduled Posts</h3>
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">Post</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($scheduledPosts as $schdeluedPost)
                                                <tr>
                                                    <td>
                                                        <a href="/pages/{{$schdeluedPost->id}}">
                                                            {{$schdeluedPost->title}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="/pages/{{$schdeluedPost->id}}/edit" class="btn btn-dark">
                                                            Edit
                                                        </a>
                                                    </td>

                                                    <td>
                                                        {{ Form::open(['action' => ['PostsController@destroy', $schdeluedPost->id], 'method' => 'POST'])}}
                                                            {{ Form::hidden('_method', 'DELETE')}}
                                                            {{ Form::Submit('Delete', ['class' => 'btn btn-danger'])}}
                                                        {{ Form::close()}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
