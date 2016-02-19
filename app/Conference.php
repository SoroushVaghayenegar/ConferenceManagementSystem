<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    public $fillable = ['name', 'description', 'capacity', 'start', 'end', 'location'];

    public function managers()
    {
      return $this->belongsToMany('App\User', 'conference_managers');
    }
}
