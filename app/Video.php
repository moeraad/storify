<?php

namespace App;

use NeoEloquent;

class Video extends NeoEloquent
{
    protected $label = "Video";
    protected $fillable = ["title","body"];


    public function author()
    {
        return $this->belongsTo('User', 'POSTED');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'ON');
    }

}
