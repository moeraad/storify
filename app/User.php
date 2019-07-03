<?php

namespace App;

use Illuminate\Auth\Authenticatable;
//use Vinelab\NeoEloquent\Eloquent\Relations\MorphMany;
//use Vinelab\NeoEloquent\Eloquent\Edges\EdgeIn;
//use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;
use NeoEloquent;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends NeoEloquent implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $label = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followers()
    {
        return $this->belongsToMany('User', 'FOLLOWS');
    }
    
    public function topics()
    {
        return $this->hasMany(Topic::class, "KNOWS_ABOUT");
    }

    public function schools()
    {
        return $this->hasMany(School::class, "STUDIED");
    }

    public function locations()
    {
        return $this->hasMany(Location::class, "LIVED");
    }

    public function interests()
    {
        return $this->hasMany(Interest::class, "CARE_ABOUT");
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class, "WORKED");
    }

    public function posts()
    {
        return $this->hasMany(Post::class, "WROTE");
    }

    public function comments($morph = null)
    {
        return $this->hyperMorph($morph, Comment::class, 'REPLIED', 'ON');
    }

    public function sentMessages(){
        return $this->hasMany(Message::class, "SENT");
    }

    public function receivedMessages(){
        return $this->hasMany(Message::class, "TO");
    }
}
