<?php

namespace App;

use NeoEloquent;

class Comment extends NeoEloquent{
    protected $label = 'Comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content','privacy','likes'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function post()
    {
        return $this->morphTo(Post::class, 'ON');
    }

    public function video()
    {
        return $this->morphTo(Video::class, 'ON');
    }
}
