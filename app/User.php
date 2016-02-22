<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function attendConferences()
    {
        return $this->belongsToMany('App\Conference', 'conference_attendees');
    }

    public function manageConferences()
    {
        return $this->belongsToMany('App\Conference', 'conference_managers');
    }

    public function attendEvents()
    {
        return $this->belongsToMany('App\Conference', 'event_attendees');
    }

    public function facilitateEvents()
    {
        return $this->belongsToMany('App\Conference', 'event_facilitators');
    }

    public function hotels()
    {
        return $this->belongsToMany('App\Hotel', 'hotel_users');
    }
}
