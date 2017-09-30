<?php


 
/** Auth Modules **/


Route::group([
    'module'    =>  'Student',
    'namespace' =>  'App\Modules\Student\Controllers'
], function(){


Route::get("/{id}", "StudentController@signup");

Route::any("/student/register", "StudentController@student_register");

Route::any("/student/submit_signup", "StudentController@submit_signup");

Route::any("student/dashboard", ["uses"=>"StudentController@dashboard"]);

/* Test Controls */

Route::any("testhome/{id}", ["uses"=>"TestController@testhome"]);

Route::any("goto_test_details/{id1}", ["uses"=>"TestController@goto_test_details"]);

Route::any("test_details/{id1}/{id2}/{id3}/{id4}/{id5}", ["uses"=>"TestController@test_details"]);

Route::any("test/submit_question", ["uses"=>"TestController@submit_question"]);

Route::post('admin/update_remaining_time','TestController@update_remaining_time');

Route::any("test/logout/{id1}/{id2}", ["uses"=>"TestController@test_logout"]);

Route::any("student/feedback", ["uses"=>"TestController@student_feedback"]);

Route::any("restart_test/{id1}/{id2}", ["uses"=>"TestController@restart_test"]);














});

?>