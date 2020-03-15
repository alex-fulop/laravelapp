<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Requests\PostStoreRequest;

class Post extends Model
{
    //Handling Dependencies
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    //Handle Request
    public function handleRequest(PostStoreRequest $request)
    {
        $this->title = $request->input('title');
        $this->body = $request->input('body');
        $this->user_id = Auth()->user()->id;
        $this->save();
    }
}
