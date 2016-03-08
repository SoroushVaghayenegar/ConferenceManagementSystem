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

    User::where('verification_code',$verification_code)->update(['verified' => 1]);

     \Session::flash('flash_message','Email successfully verified!.');


     return redirect('/');
    }
}

?>