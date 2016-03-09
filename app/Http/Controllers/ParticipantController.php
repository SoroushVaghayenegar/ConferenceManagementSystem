<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ParticipantController extends Controller
{
    public function index()
    {	
    	$current_conferences = DB::table('conferences')->where('end', '>=', date('Y-m-d').' 00:00:00')->get();

        $past_conferences = DB::table('conferences')->where('end', '<=', date('Y-m-d').' 00:00:00')->get();

        return view('manage_participants', ['current_conferences' => $current_conferences , 'past_conferences' => $past_conferences]);
    }
}
