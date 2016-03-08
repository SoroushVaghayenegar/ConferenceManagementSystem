<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'date_of_birth' => 'date|date_format:Y/m/d',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $verification_code = str_random(20);
        Mail::send('auth.emails.verification', ['verification_code' => $verification_code], function($message) {
            $message->to(Input::get('email'), Input::get('name'))
            ->subject('Gobind Sarver verification');
        });
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'date_of_birth' => 'date|date_format:Y/m/d',
            'city' => $data['city'],
            'country' => $data['country'],
            'verification_code' => $verification_code
            ]);


    }


    public function confirm($verification_code)
    {

     //User::whereConfirmationCode($verification_code)->first()->update(['verified' => 1]);

      User::where('verification_code',$verification_code)->update(['verified' => 1]);
     Flash::message({{$verification_code}});
     

       //  if($verification_code)
       //  {

       //      $user->verified = 1;
       //      $user->verification_code = null;
       //      $user->save();

       //      Flash::message('Your email is verified, you are now eligible to recieve updates!.');
       //  }
       // return redirect('/profile');
    }
}
