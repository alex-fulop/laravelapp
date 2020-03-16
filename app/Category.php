<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //handle Dependencies
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'category_post');
    }

    //Remove timestamps
    public $timestamps =  false;
}
