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

    public function managers()
    {
      return $this->belongsToMany('App\User', 'conference_managers');
    }

    public function attendees()
    {
      return $this->belongsToMany('App\Participant', 'conference_attendees');
    }


            public function facilitators()
    {
      return $this->belongsToMany('App\User', 'event_facilitators');
    }      
}
