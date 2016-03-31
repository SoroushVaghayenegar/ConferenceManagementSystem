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
      ->withPivot('flight', 'arrival_date', 'arrival_time', 'hotel_requested', 'taxi_requested', 'approved')
      ->withTimestamps();
    }

    public function events()
    {
      return $this->belongsToMany('App\Event');
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
