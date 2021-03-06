<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Log;
use App\User;
use Auth;

class LogsController extends Controller
{

    public function __construct(){
    $this->middleware('auth');
  	}


  	public function getType($type){

  		if (!Auth::user()->is_admin)
          abort(403);

  		$logs = Log::where('type', '=', $type)->orderBy('created_at', 'desc')->get();

  		$types = Log::select('type')->distinct()->get();

  		foreach($logs as $log){
  			$user = User::where('id', '=', $log->user_id)->get()->first();;
  			$log->username = $user->name;
  			$log->useremail = $user->email;
  		}

  		return view('logs', ['logs' => $logs,
  							 'types' => $types,
  							 'current' => $type]);
  	}
  	
  	public function index(){

  		if (!Auth::user()->is_admin)
          abort(403);


  		$logs = Log::orderBy('created_at', 'desc')->get();

  		$types = Log::select('type')->distinct()->get();

  		foreach($logs as $log){
  			$user = User::where('id', '=', $log->user_id)->get()->first();;
  			$log->username = $user->name;
  			$log->useremail = $user->email;
  		}

  		return view('logs', ['logs' => $logs,
  							 'types' => $types,
  							 'current' => null]);
  	}

}
