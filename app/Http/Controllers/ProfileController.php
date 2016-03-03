<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator as Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Conference;

class ProfileController extends Controller
{

    public function update()
    {
        if (isset($_POST["submit"])) {
            /* Auth::user()->name = $_POST['name'];
            Auth::user()->email = $_POST['email'];*/

            $name = $_POST['name'];
            $email = $_POST['email'];
         } 
    }

    public function index()
    {
        return view('profile');
    }
}
