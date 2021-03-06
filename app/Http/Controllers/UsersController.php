<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->is_admin == 0)
            abort(403);

        $users = User::orderBy('name', 'asc')->get();

        return view('manage_users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {
        if(Auth::user()->is_admin == 0)
            abort(403);

        $id->delete();

        Log::createLog("Delete User", "deleted user: $id->name ($id->email)");

        return redirect('manage_users');
    }

    public function set_admin(User $id)
    {
        $id->is_admin = true;
        $id->save();

        return redirect('manage_users')->with([
          "set_admin" => true
        ]);
    }

    public function set_user(User $id)
    {
        if (Auth::user()->id == $id->id)
          return redirect('manage_users')->with([
            "cannot_set_self" => true
          ]);
        $id->is_admin = false;
        $id->save();

        return redirect('manage_users')->with([
          "set_user" => true
        ]);
    }

}
