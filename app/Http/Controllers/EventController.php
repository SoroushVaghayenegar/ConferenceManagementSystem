<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator as Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Conference;
use App\Participant;
use Auth;
use DB;
use Gate;

class EventController extends Controller
{
  public function eventListIndex($id)
    {  
      
      $events = DB::table('events')->where('conference_id' , $id);
      return view('events',['events'=>$events,'id'=>$id]);
    }
}
