<?php

namespace App;

use NeoEloquent;

class Photo extends NeoEloquent
{
    protected $label = "Photo";
    protected $fillable = ["url","caption","metadata"];
}
