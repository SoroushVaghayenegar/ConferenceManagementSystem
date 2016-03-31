<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    public $fillable = ['name', 'description', 'capacity', 'start', 'end', 'location'];

    public static function getCurrentConferences()
    {
        return Conference::where('end', '>=', date('Y-m-d').' 00:00:00')->get();
    }

    public static function getPastConferences()
    {
        return Conference::where('end', '<=', date('Y-m-d').' 00:00:00')->get();
    }

    /*
    *  return true if User with $user_id is registered to the conference
    */
    public function isRegistered($user_id)
    {
        return $this->attendees()->where('user_id', $user_id)->count() > 0;
    }

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
        return $this->belongsToMany('App\Participant', 'conference_attendees', 'conference_id', 'participant_id')
        ->withPivot('flight', 'arrival_date', 'arrival_time', 'hotel_requested', 'taxi_requested', 'approved')
        ->withTimestamps();
    }

    public function getAttendees()
    {
      $participants = $this->attendees()->get();

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
      }

      return $participants;
    }

    public function hotels()
    {
        return $this->hasMany('App\Hotel');
    }

    public function inventory()
    {
        return $this->hasManyThrough('App\Inventory', 'App\Hotel');
    }
}
