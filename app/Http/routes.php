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

Route::group(['middleware' => ['web']], function () {
  //
});

Route::group(['middleware' => 'web'], function () {
  Route::auth();

  Route::get('/welcome', function () {
  return view('welcome');
});
  
  Route::get('/home', 'HomeController@index');
});

Route::group(['middleware' => 'web'], function () {

  Route::get('/directory', 'DirectoryController@index');

  /**
  * Show Conference Dashboard
  */
  Route::get('/', function () {
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

  Route::delete('/conference/{id}', 'ConferenceController@delete');

});
