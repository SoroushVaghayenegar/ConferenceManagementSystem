<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Conference;

class InventoryController extends Controller
{
    public function index()
    {
        $current_conferences = Conference::getCurrentConferences();
        $past_conferences = Conference::getPastConferences();

        return view('inventory', [
          'conferences' => $past_conferences->merge($current_conferences)
        ]);
    }

    public function show($id)
    {
        $current_conferences = Conference::getCurrentConferences();
        $past_conferences = Conference::getPastConferences();

        $conference = Conference::findOrFail($id);

        return view('inventory', [
          'conferences' => $past_conferences->merge($current_conferences),
          'current' => $conference->id,
          'inventories' => $conference->inventory
        ]);
    }
}
