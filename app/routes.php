<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
	return Redirect::to('job-posting');
});

// Route::get('about', function () {
// 	return View::make('page.about')->with('active', 'about');
// });

// Route::get('q-and-a', function () {
// 	return View::make('page.q-and-a')->with('active', 'q-and-a');
// });

// Route::get('contact', function () {
// 	return View::make('page.contact')->with('active', 'contact');
// });

Route::post('oauth/access_token', 'OAuthController@postAccessToken');

//Route::group(['before' => 'oauth', 'prefix' => 'api'], function () {
	Route::post('company/send-mail/{id}', 'CompanyController@sendMail');
	Route::resource('company', 'CompanyController');
	Route::resource('jobs', 'JobsController');
	Route::get('notifications', 'JobsController@today');
	Route::resource('ranks', 'RanksController');

//});

Route::group(['before' => 'auth'], function () {

	//Route::resource('ranks', 'RanksController');
	Route::resource('vessels', 'VesselsController');
	Route::resource('departments', 'DepartmentsController');

	// Route::resource('company', 'CompanyController');
	// Route::resource('jobs', 'JobsController');

	Route::resource('vessel-flags', 'VesselFlagsController');
	Route::resource('trade-routes', 'TradeRoutesController');

	Route::get('job-posting', function () {
		return View::make('page.job-posting')->with('active', 'job-posting');
	});

	Route::get('user', function () {
		Auth::user()->company; // change better implementation if found
		return Auth::user();
	});


});
//

// Confide routes
Route::get('signup', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('login', 'UsersController@login');
Route::post('login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('logout', 'UsersController@logout');

Route::get('test', function () {
	return Hash::make('password');
});


Route::get('clear-data', function () {
	DB::transaction(function () {
		DB::delete('DELETE FROM users WHERE id NOT IN (1)');
		DB::delete('DELETE FROM companies');
		DB::delete('DELETE FROM jobs');
	});
	return 'crystal clear ;-)';
});
