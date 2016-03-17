<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use  Validator;
use App\User;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller 
{

	public function index()
	{
		return view('auth/login');
	}

	public function login(Request $request)
	{
		$loginInfo = [
		'email' => 'required|exists:users',
		'password' => 'required'
		];

		$input = Input::only('email', 'password');

		$validator = Validator::make($input, $loginInfo);

		if($validator->fails())
		{
			return redirect()->back()
			->withInput($request->only($this->loginUsername(), 'remember'))
			->withErrors([
				$this->loginUsername() => $this->getFailedLoginMessage(),
				]);
		}


	}


        /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
        public function loginUsername()
        {
        	return property_exists($this, 'username') ? $this->username : 'email';
        }



        /**
     * Get the failed login message.
     *
     * @return string
     */
        protected function getFailedLoginMessage()
        {
        	return Lang::has('auth.failed')
        	? Lang::get('auth.failed')
        	: 'These credentials do not match our records.';
        }




    }



    ?>