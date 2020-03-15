<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CommentStoreRequest;

class Comment extends Model
{
    //Handling Dependecies
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Handling Requests
    public function handleRequest(CommentStoreRequest $request, $post_id)
    {
        $post = Post::find($post_id);
        $this->body = $request->input('body');
        $this->user_id = $request->user()->id;
        $this->post_id = $post->id;
        $this->save();
    }
}
