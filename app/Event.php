<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $fillable = ['name', 'topic', 'capacity', 'start', 'end', 'location'];

    public function conference()
    {
      return $this->belongsTo('App\Conference');
    }

    public function attendees()
    {
      return $this->belongsToMany('App\Participant', 'event_attendees');
    }


    public function facilitators()
    {
      return $this->belongsToMany('App\User', 'event_facilitators');
    }

    /*
    *  return true if User with $user_id is registered to the event
    */
    public function isRegistered($user_id)
    {
        return $this->attendees()->where('user_id', $user_id)->count() > 0;
    }


}
