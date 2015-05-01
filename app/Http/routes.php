<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
	if (isset($_SESSION['user_id'])) {
		$install_id = isset($_SESSION['app_installation_id']) ? $_SESSION['app_installation_id'] : null;
		return view('index', ['app_installation_id' => $install_id]);
	} else {
		return redirect('/login');
	}
});

$app->get('/timeline/{app_installation_id}', function($app_installation_id){
	$install = \App\Model\AppInstallation::find($app_installation_id);
	if ($install) {
		$_SESSION['app_installation_id'] = $install->app_installation_id;
	}
	return redirect('/');
});

$app->get('/oauth/callback', 'App\Http\Controllers\OAuthController@callback');

$app->get('/user/{reset_token}', 'App\Http\Controllers\UserController@setPassword');

$app->post('/user/{reset_token}', 'App\Http\Controllers\UserController@update');

$app->get('/login', 'App\Http\Controllers\UserController@login');

$app->get('/logout', 'App\Http\Controllers\UserController@logout');

$app->post('/login', 'App\Http\Controllers\UserController@authenticate');

$app->post('/user/signup/{app_installation_id}', 'App\Http\Controllers\UserController@create');

$app->post('/events', 'App\Http\Controllers\EventController@create');

$app->get('/app_installations', 'App\Http\Controllers\AppInstallationController@all');

$app->get('/app_installation/{app_installation_id}/events', 'App\Http\Controllers\AppInstallationController@getEvents');