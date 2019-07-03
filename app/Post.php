<?php

namespace App;

use NeoEloquent;

class Post extends NeoEloquent{
    protected $label = 'Post';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content','privacy','likes'];

    public function user()
    {
        return $this->belongsTo(User::class, "WROTE");
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'ON');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'PHOTO');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'VIDEO');
    }
}
