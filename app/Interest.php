<?php

namespace App;

use NeoEloquent;

class Interest extends NeoEloquent{
    protected $label = 'Interest';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class, "CARE_ABOUT");
    }
}
