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

class ConferenceController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(){
      $conferences = Conference::orderBy('created_at', 'asc')->get();

      $conference_manager = DB::table('conference_managers')->where('user_id' ,'=', Auth::user()->id)->get();

      if(Auth::user()->is_admin == 0 && $conference_manager){

            $conferences = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
                                             ->where('user_id' ,'=', Auth::user()->id)->get();
      }

    return view('conferences', [
      'conferences' => $conferences
      ]);
    }


    public function editIndex($id){
      if (Gate::denies('conf-manager-or-admin', $id)) {
        abort(403);
      }

      $conference = Conference::findOrFail($id);
      $conference->managers = $conference->managers()->get();

      return view('conference.edit', ['conference' => $conference]);
    }

    public function create(Request $request)
    {

        if(Auth::user()->is_admin == 0 )
            abort(403);

        $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'required',
          'capacity' => 'integer|min:0',
          'start' => 'required|date|date_format:Y/m/d',
          'end' => 'required|date|date_format:Y/m/d|after:start'
        ]);

        $conference = new Conference;
        $conference->name = $request->name;
        $conference->description = $request->description;
        $conference->capacity = $request->capacity;
        $conference->start = $request->start;
        $conference->end = $request->end;
        $conference->location = $request->location;
        $conference->address = $request->address;

        $conference->save();


        $conference->managers()->attach($request->managers);

        return redirect('/manage_conferences');
    }

    public function edit($id,Request $request)
    {
      $conference_manager = DB::table('conference_managers')
                                ->where('user_id' ,'=', Auth::user()->id)
                                ->where('conference_id' , '=', $id)
                                ->get();

        if(Auth::user()->is_admin == 0 AND $conference_manager == NULL)
            abort(403);

    DB::table('conference_managers')->where('conference_id' , $id)->delete();
    $conference = Conference::where('id', $id);
    $conference->update(
      ['name' => $request->name,
      'description' => $request->description,
      'capacity' => $request->capacity,
      'start' => $request->start,
      'end' => $request->end,
      'location' => $request->location,
      'address' => $request->address
      ]);



    if($request->managers != NULL){
    $conference->first()->managers()->attach($request->managers);
  }

    \Session::flash('flash_message','Conference updated.');
    return redirect()->back();
    }

    public function show($id)
    {
      if (Auth::user()) {
        $conference = Conference::findOrFail($id);
        $user = User::find(Auth::user()->id);

        // get registration details if user has joined
        $registration = $this->getRegistration($conference, $user);
        $res = [
          'conference' => $conference
        ];
        if (count($registration) > 0) {
          $res['registration'] = $registration;
        }

        return view('conference.info', $res);
      } else {
        $conference = Conference::findOrFail($id);
        $res = [
          'conference' => $conference
        ];
        return view('conference.info', $res);
      }
    }

    public function delete(Conference $id)
    {
        if(Auth::user()->is_admin == 0)
          abort(403);
        $id->delete();
        return redirect('/manage_conferences');
    }

    public function join($id, Request $request)
    {
        // create participant for primary user
        $conference = Conference::findOrFail($id);
        $hotel = isset($request->primary['hotel']) && $request->primary['hotel'] == 'on';
        $taxi = isset($request->primary['taxi']) && $request->primary['taxi'] == 'on';

        $same_flight = isset($request->primary['same_flight']) && $request->primary['same_flight'] == 'on';
        $same_hotel = isset($request->primary['same_hotel']) && $request->primary['same_hotel'] == 'on';

        $this->createAttachedParticipant([
          'user_id' => Auth::user()->id,
          'phone' => $request->primary['phone'],
          'flight' => $request->primary['flight'],
		  'arrival_date' => $request->primary['arrival_date'],
		  'arrival_time' => $request->primary['arrival_time'],
          'hotel_requested' => $hotel,
          'taxi_requested' => $taxi
        ], $conference, true);

        // create participants for other users in group
        foreach ($request->participant as $participant) {
          // skip participant if name is empty
          if (!isset($participant['name']) || strlen(trim($participant['name'])) == 0)
            continue;

          $hotel = isset($participant['hotel']) && $participant['hotel'] == 'on';
          $taxi = isset($participant['taxi']) && $participant['taxi'] == 'on';
          if ($same_flight) {
            $flight = $request->primary['flight'];
			$arrival_date = $request->primary['arrival_date'];
			$arrival_time = $request->primary['arrival_time'];
		  }
          else if (isset($participant['flight'])) {
            $flight = $participant['flight'];
			$arrival_date = $participant['arrival_date'];
			$arrival_time = $participant['arrival_time'];
		  }
          else {
            $flight = null;
			$arrival_date = null;
			$arrival_time = null;
		  }

          $this->createAttachedParticipant([
            'name' => $participant['name'],
            'phone' => $participant['phone'],
            'flight' => $flight,
			'arrival_date' => $arrival_date,
			'arrival_time' => $arrival_time,
            'user_id' => Auth::user()->id,
            'hotel_requested' => $hotel,
            'taxi_requested' => $taxi
          ], $conference, false);
        }
        return redirect("/conference/$id")->with('joined', true);
    }

    /*
    * function createAttachedParticipant()
    *
    * creates an instance of Participant from $fields and attach it to the
    * attendees list of $conference
    */
    public function createAttachedParticipant($fields, $conference, $primary = false)
    {
        $participant = new Participant;
        $participant->primary_user = $primary;
        if (!$primary)
          $participant->name = $fields['name'];
        $participant->phone = $fields['phone'];
        $participant->user_id = $fields['user_id'];
        $participant->save();

        $conference->attendees()->attach($participant, [
          "hotel_requested" => $fields['hotel_requested'],
          "taxi_requested" => $fields['taxi_requested'],
          "flight" => $fields['flight'],
		  "arrival_date" => $fields['arrival_date'],
		  "arrival_time" => $fields['arrival_time']
        ]);
        return $participant;
    }

    /*
    * function getRegistration()
    *
    * return null if user is not registered to this conference
    * return registration informations if the user is registered
    */
    public function getRegistration($conference, $user)
    {
        $participants = $user->participants;
        $participant_id = [];
        foreach ($participants as $participant)
          $participant_id[] = $participant->id;

        return $conference->attendees()->find($participant_id);
    }
}
