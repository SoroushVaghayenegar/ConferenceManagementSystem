<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

use App\Conference;
use App\Log;
use DB;
use Mail;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if(!Auth::user()->is_admin)
          abort(403);

        $current_conferences = Conference::getCurrentConferences();
        $past_conferences = Conference::getPastConferences();

        $conferences = $past_conferences->merge($current_conferences);

        return view('notification', [
          'conferences' => $conferences
        ]);
    }

    public function indexConference($id)
    {
        $conference = Conference::findOrFail($id);

        $current_conferences = Conference::getCurrentConferences();
        $past_conferences = Conference::getPastConferences();

        $conferences = $past_conferences->merge($current_conferences);

        return view('notification', [
          'conferences' => $conferences,
          'conferenceName' => $conference->name,
          'current' => $id
        ]);
    }

    public function send($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'notification' => 'required'
        ]);

        $conference = Conference::findOrFail($id);
        $users = $conference->getUsers();

        foreach ($users as $user) {
          $address = $user->email;
          $name = $user->name;

          Mail::send('emails.notification', [
            'title' => $request->title,
            'notification' => $request->notification
          ], function ($message) use ($address, $name) {
            $message->to($address, $name)
            ->subject('Notification from Gobind Sarvar Conferences');
          });
        }

        Log::createLog("Send Notification", "sent an email notification to all attendees of conference: $conference->name ");

        return redirect("/notification/conference/$id")->with([
          "notification_sent" => true
        ]);
    }
}
