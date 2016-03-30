<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Conference;
class ReportController extends Controller
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
        
        

        $current_conferences = Conference::where('end', '>=', date('Y-m-d').' 00:00:00')->get();

        $past_conferences = Conference::where('end', '<=', date('Y-m-d').' 00:00:00')->get();

        $conference_manager = DB::table('conference_managers')->where('user_id' ,'=', Auth::user()->id)->get();

        if(Auth::user()->is_admin == 0 && $conference_manager){

            $current_conferences = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
                                             ->where('end', '>=', date('Y-m-d').' 00:00:00')
                                             ->where('user_id' ,'=', Auth::user()->id)->get();

            $past_conferences = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
                                          ->where('end', '<=', date('Y-m-d').' 00:00:00')
                                             ->where('user_id' ,'=', Auth::user()->id)->get();

        }

        return view('reports', ['current_conferences' => $current_conferences , 'past_conferences' => $past_conferences, 'report' => null]);
        
    }

    public function getReport($id){

        $conference_manager = DB::table('conference_managers')
                                ->where('user_id' ,'=', Auth::user()->id)
                                ->where('conference_id' , '=', $id)
                                ->get();

        if(Auth::user()->is_admin == 0 && $conference_manager == null)
            abort(404);

        $current_conferences = Conference::where('end', '>=', date('Y-m-d').' 00:00:00')->get();

        $past_conferences = Conference::where('end', '<=', date('Y-m-d').' 00:00:00')->get();

        $conference_manager = DB::table('conference_managers')->where('user_id' ,'=', Auth::user()->id)->get();

        if(Auth::user()->is_admin == 0 && $conference_manager){

            $current_conferences = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
                                             ->where('end', '>=', date('Y-m-d').' 00:00:00')
                                             ->where('user_id' ,'=', Auth::user()->id)->get();

            $past_conferences = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
                                          ->where('end', '<=', date('Y-m-d').' 00:00:00')
                                             ->where('user_id' ,'=', Auth::user()->id)->get();

        }

        $conference = Conference::findOrFail($id);

        $participants = DB::table('conference_attendees')
                   ->join('participants', 'conference_attendees.participant_id', '=', 'participants.id')
                   ->where('conference_id', '=', $id)->get();

        //Gender count
        $male_count = 0 ;
        $female_count = 0;

        //Gender and age count

        // men
        $younger_than_ten_male = 0;
        $ten_to_twenty_male = 0;
        $twenty_to_thirty_male = 0;
        $thirty_to_forty_male = 0;
        $forty_to_fifty_male = 0;
        $fifty_to_sixty_male = 0;
        $older_than_sixty_male = 0;

        //women
        $younger_than_ten_female = 0;
        $ten_to_twenty_female = 0;
        $twenty_to_thirty_female = 0;
        $thirty_to_forty_female = 0;
        $forty_to_fifty_female = 0;
        $fifty_to_sixty_female = 0;
        $older_than_sixty_female = 0;

        foreach ($participants as $participant) {
            if($participant->gender == "Male"){
                $male_count++;

                if($participant->age < 10)
                    $younger_than_ten_male++;
                elseif($participant->age >= 10 AND $participant->age < 20)
                    $ten_to_twenty_male++;
                elseif($participant->age >= 20 AND $participant->age < 30)
                    $twenty_to_thirty_male++;
                elseif($participant->age >= 30 AND $participant->age < 40)
                    $thirty_to_forty_male++;
                elseif($participant->age >= 40 AND $participant->age < 50)
                    $forty_to_fifty_male++;
                elseif($participant->age >= 50 AND $participant->age < 60)
                    $fifty_to_sixty_male++;
                elseif($participant->age >= 60)
                    $older_than_sixty_male++;
            }
                
            if($participant->gender == "Female"){
                $female_count++;

                if($participant->age < 10)
                    $younger_than_ten_female++;
                elseif($participant->age >= 10 AND $participant->age < 20)
                    $ten_to_twenty_female++;
                elseif($participant->age >= 20 AND $participant->age < 30)
                    $twenty_to_thirty_female++;
                elseif($participant->age >= 30 AND $participant->age < 40)
                    $thirty_to_forty_female++;
                elseif($participant->age >= 40 AND $participant->age < 50)
                    $forty_to_fifty_female++;
                elseif($participant->age >= 50 AND $participant->age < 60)
                    $fifty_to_sixty_female++;
                elseif($participant->age >= 60)
                    $older_than_sixty_female++;
            }
                

        }

        

        

        

        return view('reports', ['report' => true,
                                'conference' => $conference,
                                'male_count' => $male_count, 
                                'female_count' => $female_count,
                                'younger_than_ten_male' =>$younger_than_ten_male,
                                'ten_to_twenty_male' => $ten_to_twenty_male,
                                'twenty_to_thirty_male' => $twenty_to_thirty_male,
                                'thirty_to_forty_male' => $thirty_to_forty_male,
                                'forty_to_fifty_male' => $forty_to_fifty_male,
                                'fifty_to_sixty_male' => $fifty_to_sixty_male,
                                'older_than_sixty_male' => $older_than_sixty_male, 
                                'younger_than_ten_female' => $younger_than_ten_female,
                                'ten_to_twenty_female' => $ten_to_twenty_female,
                                'twenty_to_thirty_female' => $twenty_to_thirty_female,
                                'thirty_to_forty_female' => $thirty_to_forty_female,
                                'forty_to_fifty_female' => $forty_to_fifty_female,
                                'fifty_to_sixty_female' => $fifty_to_sixty_female,
                                'older_than_sixty_female' => $older_than_sixty_female,
                                'current_conferences' => $current_conferences , 
                                'past_conferences' => $past_conferences
                                ]);
    }
}
