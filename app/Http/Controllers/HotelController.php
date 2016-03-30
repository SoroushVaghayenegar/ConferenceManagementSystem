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
    	if(Auth::user()->is_admin == 0)
        	abort(404);

				$current = Conference::getCurrentConferences();
				$past = Conference::getPastConferences();

				$conferences = $past->merge($current);

        return view('hotel', ['conferences' => $conferences]);
    }

		public function showCreate($id)
		{
			if(Auth::user()->is_admin == 0)
        		abort(404);

				$conference = Conference::findOrFail($id);
				return view('create_hotel', ['conference' => $conference]);
		}

		public function create($id, Request $request)
		{
			if(Auth::user()->is_admin == 0)
        		abort(404);

				$this->validate($request, [
					'name' => 'required|max:255',
					'address' => 'required',
					'type' => 'required',
					'capacity' => 'required|integer|min:1'
				]);

				$hotel = new Hotel;
				$hotel->name = $request->name;
				$hotel->address = $request->address;
				$hotel->type = $request->type;
				$hotel->capacity = $request->capacity;

				$conference = Conference::findOrFail($id);
				$conference->hotels()->save($hotel);

				return redirect("/conference/$id/hotels")->with("hotel_added", true);
		}

		public function show($id)
		{
			if(Auth::user()->is_admin == 0)
        		abort(404);

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
        if(Auth::user()->is_admin == 0)
        	abort(404);

        $id->delete();
        return redirect('hotel');
    }
}
