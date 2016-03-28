<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'date_of_birth', 'city', 'country','verification_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function manageConferences()
    {
        return $this->belongsToMany('App\Conference', 'conference_managers');
    }

    public function facilitateEvents()
    {
        return $this->belongsToMany('App\Conference', 'event_facilitators');
    }

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }
}
