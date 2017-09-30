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

/** Auth Modules **/


Route::any("/get_district", ["uses"=>"Auth\AuthController@get_district"]);

Route::any("/get_multiple_district", ["uses"=>"Auth\AuthController@get_multiple_district"]);

Route::any("/get_city", ["uses"=>"Auth\AuthController@get_city"]);

Route::any("college/get_degree", ["uses"=>"Auth\AuthController@get_degree"]); 

Route::any("/get_branch", ["uses"=>"Auth\AuthController@get_branch"]);

Route::any("/get_ug_branch", ["uses"=>"Auth\AuthController@get_ug_branch"]);

Route::any("/get_multiple_branch", ["uses"=>"Auth\AuthController@get_multiple_branch"]);

Route::any("/get_venue_college", ["uses"=>"Auth\AuthController@get_venue_college"]);

Route::any("/get_invited_college", ["uses"=>"Auth\AuthController@get_invited_college"]);

Route::post("get_chapter", ["uses"=>"Auth\AuthController@get_chapter"]);





Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
