<?php

namespace App;

use NeoEloquent;

class Topic extends NeoEloquent{
    protected $label = 'Topic';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class, "KNOWS_ABOUT");
    }
}
