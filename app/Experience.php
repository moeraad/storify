<?php

namespace App;

use NeoEloquent;

class Experience extends NeoEloquent{
    protected $label = 'Experience';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','location'];
    
    public function user()
    {
        return $this->belongsTo(User::class, "WORKED");
    }
}
