<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Gate;
use Auth;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Conference;
use App\Participant;
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
        $current = Conference::where('end', '>=', date('Y-m-d').' 00:00:00')->get();

        $past = Conference::where('end', '<=', date('Y-m-d').' 00:00:00')->get();

        $conference_manager = DB::table('conference_managers')->where('user_id' ,'=', Auth::user()->id)->get();


        if(Auth::user()->is_admin == 0 && $conference_manager){

            $current = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
                                             ->where('end', '>=', date('Y-m-d').' 00:00:00')
                                             ->where('user_id' ,'=', Auth::user()->id)->get();

            $past = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
                                          ->where('end', '<=', date('Y-m-d').' 00:00:00')
                                             ->where('user_id' ,'=', Auth::user()->id)->get();

        }


        return ['current' => $current, 'past' => $past];
    }

    public function index()
    {


        $conferences = $this->getConferences();

        return view('manage_participants', [
          'current' => null,
          'conferences' => $conferences['past']->merge($conferences['current'])
        ]);
    }

    public function show($id)
    {


        // Get attendees list for Conference $id
        $conference = Conference::findOrFail($id);
        $this->checkConferenceManager($conference);

        $attendees = $conference->getAttendees();

        
        $approved = DB::table('conference_attendees')
                                ->where('conference_id', '=' , $id)
                                ->where('approved', '=', 1)
                                ->count();

        $availableCapacity = $conference->capacity - $approved;

        // Get all existing and past conferences
        $conferences = $this->getConferences();

        return view('manage_participants', [
          'current' => $id,
          'conferences' => $conferences['past']->merge($conferences['current']),
          'attendees' => $attendees,
          'availableCapacity' => $availableCapacity
        ]);
    }

    public function approve($id, $participant_id)
    {

        $conference = Conference::findOrFail($id);
        $participant = Participant::findOrFail($participant_id);

        $user_email = $participant->user->email;
        $user_name = $participant->user->name;

        $participant->conferences()->updateExistingPivot($id, ["approved" => true]);

        Mail::send('emails.approve', [
          'participant' => $participant->getName(),
          'conference' => $conference->name
        ], function($message) use ($user_email, $user_name) {
            $message->to($user_email, $user_name)
            ->subject('Gobind Sarvar Conferences: Participant approved!');
        });

        return redirect("/conference/$id/participants")->with('approved', true);
    }

    public function unapprove($conference, $participant_id)
    {


        $participant = Participant::findOrFail($participant_id);

        $participant->conferences()->updateExistingPivot($conference, ["approved" => false]);

        return redirect("/conference/$conference/participants")->with('unapproved', true);
    }
}
