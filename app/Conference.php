<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    public $fillable = ['name', 'description', 'capacity', 'start', 'end', 'location'];

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function managers()
    {
        return $this->belongsToMany('App\User', 'conference_managers');
    }

    public function attendees()
    {
        return $this->belongsToMany('App\User', 'conference_attendees');
    }

    public function hotels()
    {
        return $this->hasMany('App\Hotel');
    }
}
