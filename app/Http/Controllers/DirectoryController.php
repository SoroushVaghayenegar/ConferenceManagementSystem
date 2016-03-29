<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class DirectoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $current_conferences = Conference::getCurrentConferences();
        $past_conferences = Conference::getPastConferences();

        foreach ($current_conferences as $conference) {
          $conference->isRegistered = $conference->isRegistered(Auth::user()->id);
        }

        foreach ($past_conferences as $conference) {
          $conference->isRegistered = $conference->isRegistered(Auth::user()->id);
        }
        
        return view('directory', [
          'current_conferences' => $current_conferences,
          'past_conferences' => $past_conferences
        ]);
    }
}
