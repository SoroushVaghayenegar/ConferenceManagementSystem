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

    $events = Event::where('conference_id' , $id)->get();
    return view('events',['events'=>$events,'id'=>$id]);
  }


  public function create_event_index($id)
  {


    return view('create_event',['id'=>$id]);
  }

  public function create($id,Request $request){
   if(Auth::user()->is_admin == 0 )
    abort(403);

  $conference = Conference::findOrFail($id);
  $begin =  $conference->start;
  $end =  $conference->end;


  $this->validate($request, [
    'name' => 'required|max:255',
    'description' => 'required',
    'capacity' => 'integer|min:0',
    'start' => 'required|date|date_format:Y/m/d H:i:s|after:'.$begin.'|before:'.$end,
    'end' => 'required|date|date_format:Y/m/d H:i:s|after:start|before:'.$end
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

  return redirect("/conference/$event->conference_id/eventlist");
}

public function edit_index($id)
{

  $event = Event::findOrFail($id);
  return view('edit_event',['specific_event'=>$event,'id'=>$id]);
}

public function edit($id,Request $request)
{
  $conference_manager = DB::table('conference_managers')
  ->where('user_id' ,'=', Auth::user()->id)
  ->where('conference_id' , '=', $id)
  ->get();

  if(Auth::user()->is_admin == 0 AND $conference_manager == NULL)
    abort(403);

  $event = Event::findOrFail($id);

  $conference = Conference::findOrFail($event->conference_id);
  $begin =  $conference->start;
  $end =  $conference->end;


  $this->validate($request, [
    'name' => 'required|max:255',
    'description' => 'required',
    'capacity' => 'integer|min:0',
    'start' => 'required|date|date_format:Y/m/d H:i:s|after:'.$begin.'|before:'.$end,
    'end' => 'required|date|date_format:Y/m/d H:i:s|after:start|before:'.$end
    ]);

  $event->update([
    'name' => $request->name,
    'topic' => $request->description,
    'capacity' => $request->capacity,
    'start' => $request->start,
    'end' => $request->end,
    'location' => $request->location,
    ]);

  DB::table('event_facilitators')->where('event_id' , $id)->delete();
  $event->first()->facilitators()->attach($request->facilitators);


  \Session::flash('flash_message','Event updated.');
  return redirect()->back();
}



public function join_index($id)
{
  $user = Auth::user();
  $event = Event::findOrFail($id);
  $conference = $event->conference;

  $attendees = $conference->attendees->where('user_id', $user->id);

  foreach ($attendees as $attendee) {
    if ($attendee->primary_user)
      $attendee->name = $attendee->user->name;
  }


  return view('event_register',[
    'specific_event' => $event,
    'id' => $id,
    'participants' => $attendees
    ]);
}

public function join($id, Request $request)
{
  $event = Event::findOrFail($id);

  $event->attendees()->attach($request->participants);

  $conference = $event->conference;

  return redirect("conference/$conference->id/eventlist")->with([
    "event_registered" => true
    ]);
}
public function participants($id)
{

   $event = Event::findOrFail($id);
   $participants = $event->attendees;
   $availableCapacity = $event->capacity - count($participants);
   $event_attendees = $event->attendees;
   $conference_attendees= Conference::findOrFail($event->conference_id)->attendees;

  // $conference_attendees = $event->getAttendees();


return view('event_participants',['attendees'=>$event_attendees,'availableCapacity'=>$availableCapacity,'event'=>$event,'conference_attendees'
 =>$conference_attendees]);
}
}
