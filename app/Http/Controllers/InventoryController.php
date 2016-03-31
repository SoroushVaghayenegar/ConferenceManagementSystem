<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Conference;
use App\Hotel;
use App\Inventory;

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

    public function showHotel($id)
    {
        $hotel = Hotel::findOrFail($id);

        return view('hotel_inventory', [
            'hotel' => $hotel,
            'inventories' => $hotel->inventory
        ]);
    }

    public function showCreate($id)
    {
        $hotel = Hotel::findOrFail($id);

        return view('create_inventory', [
            'hotel' => $hotel
        ]);
    }

    public function delete($id)
    {
        $inventory = Inventory::findOrFail($id);
        $hotel = Hotel::findOrFail($id);

        $inventory->delete();

        return redirect("/hotel/$hotel->id/inventory")->with([
            'inventory_deleted' => true
        ]);
    }

    public function create($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        // creating Inventory object
        $inventory = new Inventory;
        $inventory->name = $request->name;
        $inventory->type = $request->type;
        $inventory->quantity = $request->quantity;

        // attaching to Hotel
        $hotel = Hotel::findOrFail($id);
        $hotel->inventory()->save($inventory);

        return redirect("/hotel/$id/inventory")->with([
            'inventory_added' => true
        ]);
    }
}
