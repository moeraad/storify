<?php

namespace App;

use NeoEloquent;

class Message extends NeoEloquent
{
    protected $label = "Message";
    protected $fillable = ["content"];

    public function author()
    {
        return $this->belongsTo(User::class, "SENT");
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, "TO");
    }
}
