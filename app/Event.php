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

     public function getAttendees()
    {
          $event_participants = $this->attendees()->get();
          $participants = Conference::findOrFail($this->conference_id)->attendees;

          foreach ($participants as $participant) {
            if ($participant->primary_user) {
              $participant->name = User::findOrFail($participant->user_id)->name;
            }

          $participant->flight = $participant->pivot->flight;
              $participant->arrival_date = $participant->pivot->arrival_date;
              $participant->arrival_time = $participant->pivot->arrival_time;
          $participant->hotel_requested = $participant->pivot->hotel_requested;
          $participant->taxi_requested = $participant->pivot->taxi_requested;
          $participant->approved = $participant->pivot->approved;

          $participant->hotel = $participant->getHotel($this->id);
      }
      return $participants;



}

}
