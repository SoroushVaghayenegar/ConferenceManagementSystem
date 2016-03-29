<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $hotels = Hotel::get();

        $hotel_users = DB::table('hotel_users')->get();

        return view('hotel', ['hotels' => $hotels , 'hotel_users' => $hotel_users]);
        
    }

    public function destroy(Hotel $id)
    {
        $id->delete();
        return redirect('hotel');
    }
}
