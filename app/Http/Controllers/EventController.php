<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator as Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Conference;
use App\Event;
use App\Participant;
use Auth;
use DB;
use Gate;

class EventController extends Controller
{
  public function eventListIndex($id)
    {  
      
      $events = DB::table('events')->where('conference_id' , $id)->get();
      return view('events',['events'=>$events,'id'=>$id]);
    }


      public function create_event_index($id)
    {  
      

      return view('create_event',['id'=>$id]);
    }

    public function create($id,Request $request){
       if(Auth::user()->is_admin == 0 )
            abort(403);

        $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'required',
          'capacity' => 'integer|min:0',
          'start' => 'required|date|date_format:Y/m/d',
          'end' => 'required|date|date_format:Y/m/d|after:start'
        ]);


        $event = new Event;

        $event->name = $request->name;
        $event->conference_id = $id;
        $event->topic = $request->description;
        $event->capacity = $request->capacity;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->location = $request->location;

        $event->save();

        $event->facilitators()->attach($request->facilitators);

        return redirect('/conference/{{$id}}/eventlist');




    }
}
