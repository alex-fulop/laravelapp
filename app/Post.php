<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Carbon;
use App\Http\Scopes\ScheduleScope;

class Post extends Model
{
    //Handling Global Scope
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ScheduleScope);
    }

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
        if ($request->input('schedule') !== '') {
            // Try with CreateFromFormat if it doesn't work
            $this->created_at = Carbon::parse($request->input('schedule'));
        }
        $this->user_id = Auth()->user()->id;
        $this->save();
    }
}
