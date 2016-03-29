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
}
