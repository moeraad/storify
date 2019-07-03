<?php

namespace App;

use NeoEloquent;

class School extends NeoEloquent{
    protected $label = 'School';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','location'];

    public function user()
    {
        return $this->belongsTo(User::class, "STUDIED");
    }
}
