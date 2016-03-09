<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Conference;
use App\User;
use Illuminate\Http\Request;

/*
Route::get('/welcome', function () {
  return view('welcome');
});
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => 'web'], function () {

  Route::auth();

  Route::get('/profile', 'ProfileController@index');
  Route::post('/profile', 'ProfileController@update');


  Route::get('/', function () {
    return view('welcome');
  });

  Route::get('/manage_users', function () {
    $users = User::orderBy('created_at', 'asc')->get();

    return view('manage_users', [
      'users' => $users
    ]);
  });

  Route::get('/home', 'HomeController@index');

  Route::get('/directory', 'DirectoryController@index');

  Route::get('/manage_participants', 'ParticipantController@index');

  Route::get('/hotel', 'HotelController@index');

  Route::get('/flights', 'FlightController@index');


  /**
  * Show Conference Dashboard
  */
  Route::get('/create_conference', function () {
    $conferences = Conference::orderBy('created_at', 'asc')->get();

    return view('conferences', [
      'conferences' => $conferences
    ]);

    //
  });

  /**
  * Add New Conference
  */
  Route::post('/conference', 'ConferenceController@create');

  Route::get('/conference/{id}', 'ConferenceController@show')->where('id', '[0-9]+');

  Route::delete('/conference/{id}', 'ConferenceController@delete');

  Route::get('/conference/{id}/join', function (Conference $id) {
    return view('conference.join', ['conference' => $id]);
  });

  Route::post('/conference/{id}/join', 'ConferenceController@join');

  Route::get('/user/autocomplete', function (Request $request) {
    $users = User::get();
    $res = [];
    foreach ($users as $user) {
      $entry = ['id' => $user->id, 'name' => $user->name];
      $res[] = $entry;
    }

    return response()->json($res);
  });
});
