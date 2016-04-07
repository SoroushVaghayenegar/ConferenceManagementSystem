<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gate;
use App\Conference;
use App\Participant;
use App\User;
use Auth;

class FlightController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function checkConferenceManager($conference)
    {
        if (Gate::denies('conf-manager-or-admin', $conference)) {
            abort(403);
        }
    }
	
    public function getConferences()
    {

        $current = Conference::where('end', '>=', date('Y-m-d').' 00:00:00')->get();

        $conference_manager = DB::table('conference_managers')->where('user_id' ,'=', Auth::user()->id)->get();


        if(Auth::user()->is_admin == 0 && $conference_manager){

            $current = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
                                             ->where('end', '>=', date('Y-m-d').' 00:00:00')
                                             ->where('user_id' ,'=', Auth::user()->id)->get();

        }

        return ['current' => $current];
    }
	
    public function index()
    {
        if(!Auth::user()->is_admin)
            abort(403);

        $conferences = $this->getConferences();
        return view('flights', [
          'current' => null,
          'conferences' => $conferences['current']
        ]);
    }

    public function show($id)
    {


        // Get attendees list for Conference $id
        $conference = Conference::findOrFail($id);
        $this->checkConferenceManager($conference);

        $attendees = $conference->getAttendees();

        // Get all existing and past conferences
        $conferences = $this->getConferences();

        return view('flights', [
          'current' => $id,
          'conferenceName' => $conference->name,
          'conferences' => $conferences['current'],
          'attendees' => $attendees
        ]);
    }
}
