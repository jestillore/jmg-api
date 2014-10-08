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

Route::get('/', function()
{
	$arr = ['test' => 'test'];
	return array_get($arr, 'yeah');
});

Route::post('oauth/access_token', function() {
    return AuthorizationServer::performAccessTokenFlow();
});

Route::group(['before' => 'oauth'], function () {

	Route::resource('company', 'CompanyController');
	Route::resource('jobs', 'JobsController');

});
