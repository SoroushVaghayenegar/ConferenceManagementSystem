<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator as Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Conference;

class ConferenceController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'required',
          'capacity' => 'integer|min:0',
          'start' => 'date|date_format:Y/m/d',
          'end' => 'date|date_format:Y/m/d|after:start'
        ]);

        $conference = new Conference;
        $conference->name = $request->name;
        $conference->description = $request->description;
        $conference->capacity = $request->capacity;
        $conference->start = $request->start;
        $conference->end = $request->end;
        $conference->save();

        $conference->managers()->attach($request->managers);

        return redirect('/');
    }

    public function delete(Conference $id)
    {
        $id->delete();
        return redirect('/');
    }
}
