<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Conference;
use Auth;

class HotelController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$conference_manager = DB::table('conference_managers')->where('user_id' ,'=', Auth::user()->id)->get();

        if(Auth::user()->is_admin == 0 && $conference_manager == null)
            abort(403);

				$current = Conference::getCurrentConferences();
				$past = Conference::getPastConferences();

				$conference_manager = DB::table('conference_managers')->where('user_id' ,'=', Auth::user()->id)->get();


		        if(Auth::user()->is_admin == 0 && $conference_manager){

		            $current = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
		                                             ->where('end', '>=', date('Y-m-d').' 00:00:00')
		                                             ->where('user_id' ,'=', Auth::user()->id)->get();

		            $past = Conference::join('conference_managers', 'conferences.id', '=', 'conference_managers.conference_id')
		                                          ->where('end', '<=', date('Y-m-d').' 00:00:00')
		                                             ->where('user_id' ,'=', Auth::user()->id)->get();

		        }

				$conferences = $past->merge($current);

        return view('hotel', ['conferences' => $conferences]);
    }

		public function showCreate($id)
		{
			$conference_manager = DB::table('conference_managers')
                                ->where('user_id' ,'=', Auth::user()->id)
                                ->where('conference_id' , '=', $id)
                                ->get();

        if(Auth::user()->is_admin == 0 && $conference_manager == null)
            abort(403);

				$conference = Conference::findOrFail($id);
				return view('create_hotel', ['conference' => $conference]);
		}

		public function create($id, Request $request)
		{
			$conference_manager = DB::table('conference_managers')
                                ->where('user_id' ,'=', Auth::user()->id)
                                ->where('conference_id' , '=', $id)
                                ->get();

        	if(Auth::user()->is_admin == 0 && $conference_manager == null)
            abort(403);

				$this->validate($request, [
					'name' => 'required|max:255',
					'room' => 'required',
					'address' => 'required',
					'type' => 'required',
					'capacity' => 'required|integer|min:1'
				]);

				$hotel = new Hotel;
				$hotel->name = $request->name;
				$hotel->room = $request->room;
				$hotel->address = $request->address;
				$hotel->type = $request->type;
				$hotel->capacity = $request->capacity;

				$conference = Conference::findOrFail($id);
				$conference->hotels()->save($hotel);

				return redirect("/conference/$id/hotels")->with("hotel_added", true);
		}

		public function show($id)
		{
			$conference_manager = DB::table('conference_managers')
                                ->where('user_id' ,'=', Auth::user()->id)
                                ->where('conference_id' , '=', $id)
                                ->get();

        if(Auth::user()->is_admin == 0 && $conference_manager == null)
            abort(403);

				$current = Conference::getCurrentConferences();
				$past = Conference::getPastConferences();

				$conferences = $past->merge($current);

				$conference = Conference::findOrFail($id);
				$hotels = $conference->hotels()->get();

				return view('hotel', [
					'conferences' => $conferences,
					'hotels' => $hotels,
					'current' => $id
				]);
		}

    public function destroy(Hotel $id)
    {
        $conference_manager = DB::table('conference_managers')
                                ->where('user_id' ,'=', Auth::user()->id)
                                ->where('conference_id' , '=', $id)
                                ->get();

        if(Auth::user()->is_admin == 0 && $conference_manager == null)
            abort(403);

        $id->delete();
        return redirect('hotel');
    }
}
