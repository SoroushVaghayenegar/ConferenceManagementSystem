<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gate;
use App\Conference;
use App\User;

class ParticipantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    *  Only admin or conference managers are allowed to access Participants
    */
    public function checkConferenceManager($conference)
    {
        if (Gate::denies('conf-manager-or-admin', $conference)) {
            abort(403);
        }
    }
    /*
    *  Get all conferences, past or current
    *  @return: ['current' => CURRENT_CONFERENCES, 'past' => PAST_CONFERENCES]
    */
    public function getConferences()
    {
        $current = DB::table('conferences')->where('end', '>=', date('Y-m-d').' 00:00:00')->get();

        $past = DB::table('conferences')->where('end', '<=', date('Y-m-d').' 00:00:00')->get();

        return ['current' => $current, 'past' => $past];
    }

    public function index()
    {
        $conferences = $this->getConferences();

        return view('manage_participants', ['current_conferences' => $conferences['current'], 'past_conferences' => $conferences['past']]);
    }

    public function show($id)
    {
        // Get attendees list for Conference $id
        $conference = Conference::findOrFail($id);
        $this->checkConferenceManager($conference);

        $attendees = $conference->getAttendees();

        // Get all existing and past conferences
        $conferences = $this->getConferences();

        return view('manage_participants', [
          'current_conferences' => $conferences['current'],
          'past_conferences' => $conferences['past'],
          'attendees' => $attendees
        ]);
    }
}
