<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator as Validator;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Conference;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {    session_start();
        $id = Auth::user()->id;
        if (isset($request->submit)) {
            $name = $request->name;
            $city = $request->city;
            $country = $request->country;
            $date_of_birth = $request->date_of_birth;
            

            User::where('id', $id)
            ->update(['name' => $name,
                      'date_of_birth' => $date_of_birth,
                      'city' => $city,
                      'country' => $country]);

         } 
     
        return redirect('/profile');
    }

    public function index()
    {
        return view('profile');
    }
}
