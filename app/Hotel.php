<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public $fillable = ['name', 'type', 'capacity'];

    public function conference()
    {
        return $this->belongsTo('App\Conference');
    }

    public function residents()
    {
        return $this->belongsToMany('App\User', 'hotel_users');
    }
}
