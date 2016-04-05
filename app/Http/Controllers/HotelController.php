<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// Models
use App\Conference;
use App\Participant;
use App\Hotel;
use App\Log;

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

				Log::createLog("Create Hotel", "created hotel: $hotel->name  (room number: $hotel->room)");

				return redirect("/conference/$id/hotels")->with("hotel_added", true);
		}

		public function getHotels($id)
		{

			$conference = Conference::findOrFail($id);
			$hotels = $conference->getHotels();

			return $hotels;
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
				$hotels = $this->getHotels($id);

				return view('hotel', [
					'conferences' => $conferences,
					'hotels' => $hotels,
					'current' => $id
				]);
		}

		public function showJSON($id)
		{
				$hotels = $this->getHotels($id);
				foreach ($hotels as $hotel) {
					$hotel->remaining = $hotel->getRemainingCapacity();
				}

				return response()->json($hotels);
		}

		public function assignHotel($conference, $participant_id, $hotel)
		{
				$participant = Participant::findOrFail($participant_id);
				$participant->hotel()->attach($hotel);

				$hotelName = Hotel::findOrFail($hotel)->name;
				$hotelRoomNumber = Hotel::findOrFail($hotel)->room;
				$participantName = $participant->name;
				$conferenceName = Conference::findOrFail($conference)->name;
				Log::createLog("Assign Hotel", "assigned hotel: $hotelName  (room number: $hotelRoomNumber) to $participantName for conference: $conferenceName");

				return redirect("conference/$conference/participants")->with([
						"hotel_assigned" => true
				]);
		}

    public function destroy($id)
    {
        $conference_manager = DB::table('conference_managers')
                                ->where('user_id' ,'=', Auth::user()->id)
                                ->where('conference_id' , '=', $id)
                                ->get();

        if(Auth::user()->is_admin == 0 && $conference_manager == null)
            abort(403);

				$hotel = Hotel::findOrFail($id);

				$conference_id = $hotel->conference->id;

        Log::createLog("delete Hotel", "deleted hotel: $hotel->name  (room number: $hotel->room)");

        $hotel->delete();

        return redirect("conference/$conference_id/hotels")->with([
					'hotel_removed' => true
				]);
    }
}
