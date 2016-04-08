<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function conferences()
    {
        return $this->belongsToMany('App\Conference', 'conference_attendees')
        ->withPivot('sprequest', 'flight', 'arrival_date', 'arrival_time', 'hotel_requested', 'taxi_requested', 'approved')
        ->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany('App\Event');
    }

    public function hotel()
    {
        return $this->belongsToMany('App\Hotel', 'hotel_users');
    }

    public function getHotel($conference_id)
    {
        return $this->hotel()->where("conference_id", $conference_id)->first();
    }

    /*
    *  If participant is the primary user, then need to get the user's name
    */
    public function getName()
    {
        if ($this->primary_user)
          return $this->user->name;
        else
          return $this->name;
    }
}
