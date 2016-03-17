<?php

namespace App\Http\Controllers;

use App\User;
use Flash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VerificationController extends Controller{

	public function confirm($verification_code)
	{
		$current_code = User::where('verification_code',$verification_code)->value('verification_code');
		$current_status = User::where('verification_code',$verification_code)->value('verified');
		if($verification_code == $current_code){
			User::where('verification_code',$verification_code)->update(['verified' => true,'verification_code'=> NULL]);
			\Session::flash('flash_message','Email successfully verified!.');
		}else {
			\Session::flash('flash_message','Email has already been verified!.');	
		}



		return redirect('/login');
	}
}