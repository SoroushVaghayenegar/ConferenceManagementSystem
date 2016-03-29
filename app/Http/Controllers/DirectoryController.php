<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Http\Requests;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{

    public function index()
    {
        $current_conferences = Conference::where('end', '>=', date('Y-m-d').' 00:00:00')->get();

        $past_conferences = Conference::where('end', '<=', date('Y-m-d').' 00:00:00')->get();

        return view('directory', ['current_conferences' => $current_conferences , 'past_conferences' => $past_conferences]);

    }
}
