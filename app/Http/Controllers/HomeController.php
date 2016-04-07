<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Participant;
use Auth;
use DB;

class HomeController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    //$this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    if (Auth::user()) {
      $conferences = Conference::where('end', '>=', date('Y-m-d').' 00:00:00')->get();
      $conferences_registered = [];
      $user = User::find(Auth::user()->id);
      $hotels = DB::table('hotels');
      $hotel_users =  DB::table('hotel_users');

      $participants = $user->participants;
      $participant_id = [];
      foreach ($participants as $participant){
        $participant_id[] = $participant->id;
      }

      foreach ($conferences as $conference){
        $registration = $conference->attendees()->find($participant_id);
        if (count($registration) > 0) {
          $conferences_registered[] = $conference;
        }
      }
      return view('home', ['conferences' => $conferences_registered,'participants' => $participants,
        'hotels' => $hotels,'hotel_users' => $hotel_users]);
    } else {

      $current_conferences = Conference::getCurrentConferences();
      foreach ($current_conferences as $conference) {
        $conference->approved = DB::table('conference_attendees')
        ->where('conference_id', '=' , $conference->id)
        ->where('approved', '=', 1)
        ->count();

      }

      return view('home', ['current_conferences' => $current_conferences]);
    }
  }
}
