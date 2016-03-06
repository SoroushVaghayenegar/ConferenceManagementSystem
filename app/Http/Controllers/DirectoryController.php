<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

class DirectoryController extends Controller
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

    public function index()
    {
        $current_conferences = DB::table('conferences')->where('end','>=', time())->get();

        $past_conferences = DB::table('conferences')->where('end','=<', time())->get();

        return view('directory', ['current_conferences' => $current_conferences , 'past_conferences' => $past_conferences]);
        
    }
}
