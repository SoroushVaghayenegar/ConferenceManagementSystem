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
      return $this->belongsToMany('App\Conference')
      ->withTimestamps();
    }

    public function events()
    {
      return $this->belongsToMany('App\Event');
    }
}
