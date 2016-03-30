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
        $current = Conference::where('end', '>=', date('Y-m-d').' 00:00:00')->get();

        $past = Conference::where('end', '<=', date('Y-m-d').' 00:00:00')->get();

        return ['current' => $current, 'past' => $past];
    }

    public function index()
    {
        if(Auth::user()->is_admin == 0)
            abort(404);

        $conferences = $this->getConferences();

        return view('manage_participants', [
          'current' => null,
          'conferences' => $conferences['past']->merge($conferences['current'])
        ]);
    }

    public function show($id)
    {
        if(Auth::user()->is_admin == 0)
            abort(404);

        // Get attendees list for Conference $id
        $conference = Conference::findOrFail($id);
        $this->checkConferenceManager($conference);

        $attendees = $conference->getAttendees();

        // Get all existing and past conferences
        $conferences = $this->getConferences();

        return view('manage_participants', [
          'current' => $id,
          'conferences' => $conferences['past']->merge($conferences['current']),
          'attendees' => $attendees
        ]);
    }

    public function approve($conference, $participant_id)
    {
        if(Auth::user()->is_admin == 0)
            abort(404);

        $participant = Participant::findOrFail($participant_id);

        $participant->conferences()->updateExistingPivot($conference, ["approved" => true]);

        return redirect("/conference/$conference/participants")->with('approved', true);
    }

    public function unapprove($conference, $participant_id)
    {
        if(Auth::user()->is_admin == 0)
            abort(404);

        $participant = Participant::findOrFail($participant_id);

        $participant->conferences()->updateExistingPivot($conference, ["approved" => false]);

        return redirect("/conference/$conference/participants")->with('unapproved', true);
    }
}
