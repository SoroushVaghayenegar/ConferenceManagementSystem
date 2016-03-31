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

//Route::get('/directory', 'DirectoryController@index');




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


  //only authenticated users can access
  Route::get('manage_users', 'UsersController@index');
  Route::get('manage_users/{id}', 'UsersController@destroy');



  Route::get('/register/verify', function(){

    if(Auth::check())
     abort(404);
    else
      return view('auth.verify');
  });

  Route::get('/', 'HomeController@index');

    /**
  * Manages login
  */

    Route::get('/login', 'LoginController@index');

    Route::post('/login', 'LoginController@login');


    /*************************************************/

    Route::get('/home', 'HomeController@index');

    Route::get('/verify', function(){
      return view('auth/verify');
    });

    Route::get('/directory', 'DirectoryController@index');

    Route::get('/manage_participants', 'ParticipantController@index');

    Route::get('/hotel', 'HotelController@index');

    Route::get('/conference/{id}/hotels-json', 'HotelController@showJSON');

    Route::get('/conference/{conference}/participant/{participant_id}/assign-hotel/{hotel}', 'HotelController@assignHotel');

    Route::get('/conference/{id}/hotels', 'HotelController@show');

    Route::get('/conference/{id}/create_hotel', 'HotelController@showCreate');

    Route::post('/conference/{id}/create_hotel', 'HotelController@create');

    Route::get('/hotel/{id}', 'HotelController@destroy');

    Route::get('/hotel/{id}/inventory', 'InventoryController@showHotel');

    Route::get('/hotel/{id}/create_inventory', 'InventoryController@showCreate');

    Route::post('/hotel/{id}/create_inventory', 'InventoryController@create');

    Route::get('/inventory', 'InventoryController@index');

    Route::get('/inventory/{id}/delete', 'InventoryController@delete');

    Route::get('/conference/{id}/inventory', 'InventoryController@show');

    Route::get('/flights', 'FlightController@index');

    Route::get('/reports', 'ReportController@index');

    Route::get('/reports/{id}', 'ReportController@getReport');

    Route::get('/verify/{verificationCode}','VerificationController@confirm');

  /**
  * Show Conference Dashboard
  */
  Route::get('manage_conferences', 'ConferenceController@index');

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


  Route::get('/conference/{id}/participants', 'ParticipantController@show');

  Route::get('/approve/conference/{id}/participant/{participant_id}', 'ParticipantController@approve');

  Route::get('/unapprove/conference/{conference}/participant/{participant_id}', 'ParticipantController@unapprove');

  Route::get('/conference/{id}/flights', 'FlightController@show');


  // Route::get('/conference/{id}/edit', function (Conference $id) {
  //   if (Gate::denies('conf-manager-or-admin', $id)) {
  //           abort(403);
  //       }
  //   return view('conference.edit', ['conference' => $id]);
  // });

  Route::get('/conference/{id}/edit','ConferenceController@editIndex');

  Route::post('/conference/{id}/edit', 'ConferenceController@edit');

   Route::get('/conference/{id}/eventlist','EventController@eventListIndex');

  Route::get('/user/autocomplete', function (Request $request) {
    $users = User::get();
    $res = [];
    foreach ($users as $user) {
      $entry = ['id' => $user->id, 'name' => $user->name];
      $res[] = $entry;
    }

    return response()->json($res);
  });

  // Notification routes

  Route::get('/notification', 'NotificationController@index');

  Route::get('/notification/conference/{id}', 'NotificationController@indexConference');

  Route::post('/notification/conference/{id}', 'NotificationController@send');
});
