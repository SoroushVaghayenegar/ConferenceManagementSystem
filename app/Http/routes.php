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

Route::get('/', function () {
    return view('welcome');
});

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

    Route::get('/home', 'HomeController@index');
});

use App\Conference;
use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {

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
    Route::post('/conference', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $conference = new Conference;
    $conference->name = $request->name;
    $conference->save();

    return redirect('/');
    // Create conference
});

    Route::delete('/conference/{conference}', function (Conference $conference) {
    $conference->delete();

    return redirect('/');
});

});
