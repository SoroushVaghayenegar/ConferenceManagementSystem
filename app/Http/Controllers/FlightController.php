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
        return ['current' => $current];
    }
	
    public function index()
    {
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
          'conferences' => $conferences['current'],
          'attendees' => $attendees
        ]);
    }
}
