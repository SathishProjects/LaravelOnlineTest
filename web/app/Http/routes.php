<?php

 
/** Auth Modules **/
Route::get("/", ["uses"=>"Auth\AuthController@viewLogin"]);

/** Get General records **/

Route::any("/get_district", ["uses"=>"Auth\AuthController@get_district"]);

Route::any("/get_multiple_district", ["uses"=>"Auth\AuthController@get_multiple_district"]);

Route::any("/get_city", ["uses"=>"Auth\AuthController@get_city"]);

Route::any("/get_branch", ["uses"=>"Auth\AuthController@get_branch"]);

Route::any("/get_ug_branch", ["uses"=>"Auth\AuthController@get_ug_branch"]);

Route::any("/get_multiple_branch", ["uses"=>"Auth\AuthController@get_multiple_branch"]);

Route::post("get_chapter", ["uses"=>"Auth\AuthController@get_chapter"]);


Route::any("/get_venue_college", ["uses"=>"Auth\AuthController@get_venue_college"]);
Route::any("/get_invited_college", ["uses"=>"Auth\AuthController@get_invited_college"]);

/**  **/

/** User Authentication **/
Route::post("auth/login", ["uses"=>"Auth\AuthController@login"]);

Route::post("auth/testlogin/check", ["uses"=>"Auth\AuthController@testlogin_check"]);

Route::get("auth/logout", ["uses"=>"Auth\AuthController@logout"]);



?>