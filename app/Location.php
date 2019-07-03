<?php

namespace App;

use NeoEloquent;

class Location extends NeoEloquent{
    protected $label = 'Location';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country','state','city','from','to','current'];

    public function user()
    {
        return $this->belongsTo(User::class, "LIVED");
    }
}
