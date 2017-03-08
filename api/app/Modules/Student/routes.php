<?php


 
/** Auth Modules **/


Route::group([
    'module'    =>  'Student',
    'namespace' =>  'App\Modules\Student\Controllers'
], function(){




Route::any("/student/GetBatchById", "StudentController@GetBatchById");

Route::any("/student/get_signup_details", ["uses"=>"StudentController@student_get_signup_details"]);

Route::any("student/submit_signup", ["uses"=>"StudentController@submit_signup"]);

Route::any("student/dashboard_details", ["uses"=>"StudentController@dashboard_details"]);


Route::post("student/create_test_login", ["uses"=>"TestController@create_test_login"]);

Route::post("student/get_question_paper", ["uses"=>"TestController@get_question_paper"]);

Route::post("student/check_login", ["uses"=>"TestController@check_login"]);

Route::post("student/test_question_details", ["uses"=>"TestController@test_question_details"]);

Route::post("student/submit_question", ["uses"=>"TestController@submit_question"]);

Route::post("student/update_remaining_time", ["uses"=>"TestController@update_remaining_time"]);

Route::post("student/test/logout", ["uses"=>"TestController@test_logout"]);

Route::any("student/feedback", ["uses"=>"TestController@student_feedback"]);













});

?>