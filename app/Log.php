<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Log extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function createLog($type, $activity)
    {
        // if user is not authenticated, do nothing
        if (!Auth::user())
          return;

        $user_id = Auth::user()->id;
        $log = new Log();
        $log->type = $type;
        $log->activity = $activity;
        $log->user_id = $user_id;

        $log->save();
        return $log;
    }

    /*
    *  Get all logs of the type specified
    */
    public static function getLogsByType($type)
    {
        return Log::where("type", "=", $type)->get();
    }
}
