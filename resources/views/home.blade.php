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
                            {{-- Scheduled posts Section --}}

                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
