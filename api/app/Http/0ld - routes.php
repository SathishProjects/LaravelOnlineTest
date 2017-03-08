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

Route::any("/get_branch", ["uses"=>"Auth\AuthController@get_branch"]);

Route::any("/get_ug_branch", ["uses"=>"Auth\AuthController@get_ug_branch"]);

Route::any("/get_multiple_branch", ["uses"=>"Auth\AuthController@get_multiple_branch"]);

Route::any("/get_venue_college", ["uses"=>"Auth\AuthController@get_venue_college"]);

Route::any("/get_invited_college", ["uses"=>"Auth\AuthController@get_invited_college"]);

Route::any("/get_batch_degree_details", ["uses"=>"Auth\AuthController@get_batch_degree_details"]);




Route::any("/student/get_signup_details", ["uses"=>"Auth\AuthController@student_get_signup_details"]); 



Route::any("/student/testlogin_check", ["uses"=>"AdminController@testlogin_check"]); 

Route::post("auth/viewLogin", ["uses"=>"Auth\AuthController@viewLogin"]);

Route::post("admin/check_token", ["uses"=>"AdminController@check_token"]);

Route::any("admin/get_college", ["uses"=>"AdminController@get_college"]);

Route::post("admin/dashboard_batch_details", ["uses"=>"AdminController@dashboard_batch_details"]);

Route::post("admin/dashboard_questionpaper_details", ["uses"=>"AdminController@dashboard_questionpaper_details"]);

Route::post("admin/set_questionpaper", ["uses"=>"AdminController@set_questionpaper"]);

Route::post("admin/get_questionpaper_detail", ["uses"=>"AdminController@get_questionpaper_detail"]);

Route::post("admin/edit_questionpaper", ["uses"=>"AdminController@edit_questionpaper"]);

Route::post("admin/update_questionpaper", ["uses"=>"AdminController@update_questionpaper"]);

Route::post("get_chapter", ["uses"=>"AdminController@get_chapter"]);

Route::post("admin/get_section_chapter", ["uses"=>"AdminController@get_section_chapter"]);

Route::post("admin/get_questionpaper_detail", ["uses"=>"AdminController@get_questionpaper_detail"]);

Route::any("admin/get_questionpaper_detail2", ["uses"=>"AdminController@get_questionpaper_detail2"]);

Route::post('admin/add_section','AdminController@add_section');

Route::post('admin/add_question','AdminController@add_question');

Route::post('admin/update_question','AdminController@update_question');

Route::post('admin/set_question_option_image_url','AdminController@set_question_option_image_url');

Route::post('admin/update_section_image_url','AdminController@update_section_image_url');

Route::post('admin/update_question_image_url','AdminController@update_question_image_url');

Route::post('admin/update_option_image_url','AdminController@update_option_image_url');

Route::post('admin/update_section','AdminController@update_section');

Route::post('admin/delete_section','AdminController@delete_section');

Route::post('admin/delete_option','AdminController@delete_option');

Route::post("admin/set_batch", ["uses"=>"AdminController@set_batch"]);

Route::get("admin/getcollege", ["uses"=>"AdminController@getcollege"]);

Route::post("admin/check_questionpaper", ["uses"=>"AdminController@check_questionpaper"]);

Route::post("admin/update_batch", ["uses"=>"AdminController@update_batch"]);

Route::post("admin/updatetest_status", ["uses"=>"AdminController@updatetest_status"]);

Route::post("admin/edit_batch", ["uses"=>"AdminController@edit_batch"]);

Route::post("admin/view_batch_details", ["uses"=>"AdminController@view_batch_details"]);

Route::post("admin/view_question_paper", ["uses"=>"AdminController@view_question_paper"]);

Route::post("admin/get_option_details", ["uses"=>"AdminController@get_option_details"]);

Route::post("admin/test_question_details", ["uses"=>"AdminController@test_question_details"]);

Route::post("admin/submit_question", ["uses"=>"AdminController@submit_question"]);

Route::post("admin/get_question_paper", ["uses"=>"AdminController@get_question_paper"]);

Route::post("admin/update_remaining_time", ["uses"=>"AdminController@update_remaining_time"]);

Route::post("admin/check_login", ["uses"=>"AdminController@check_login"]);

Route::post("admin/create_test_login", ["uses"=>"AdminController@create_test_login"]);

Route::post("admin/test/logout", ["uses"=>"Auth\AuthController@test_logout"]);

Route::post("auth/check_test_id", ["uses"=>"Auth\AuthController@check_test_id"]);

Route::post("auth/check_test_login_id", ["uses"=>"Auth\AuthController@check_test_login_id"]);

Route::post("admin/testkey", ["uses"=>"AdminController@testkey"]);

Route::post("admin/batchinstance", ["uses"=>"AdminController@batchinstance"]);

Route::post("admin/testreport", ["uses"=>"AdminController@testreport"]);

Route::post("admin/full_testreport", ["uses"=>"AdminController@full_testreport"]);

Route::post("admin/export_feedback", ["uses"=>"AdminController@export_feedback"]);

Route::post("admin/download_college_students", ["uses"=>"AdminController@download_college_students"]);

Route::post("admin/download_all_college_students", ["uses"=>"AdminController@download_all_college_students"]);

Route::post("testadmin/testreport", ["uses"=>"AdminController@testadmin_testreport"]);

Route::post("admin/individual_testreport", ["uses"=>"AdminController@individual_testreport"]);

Route::post("admin/testadmin_logout", ["uses"=>"AdminController@testadmin_logout"]);

Route::post("admin/endtestinstance", ["uses"=>"AdminController@endtestinstance"]);

Route::post("testadmin/feedback", ["uses"=>"AdminController@testadmin_feedback"]);

Route::any("student/feedback", ["uses"=>"AdminController@student_feedback"]);


Route::any("testadmin/starttest", ["uses"=>"AdminController@testadmin_starttest"]);

Route::any("testadmin/assign_starttest", ["uses"=>"AdminController@assign_starttest"]);

Route::any("testadmin/endtest", ["uses"=>"AdminController@testadmin_endtest"]);

Route::any("admin/delete_test", ["uses"=>"AdminController@delete_test"]);

Route::any("testadmin/reappear_student", ["uses"=>"AdminController@reappear_student"]);

Route::any("testadmin/viewstudents", ["uses"=>"AdminController@testadmin_viewstudents"]);

Route::any("admin/viewstudents", ["uses"=>"AdminController@admin_viewstudents"]);

Route::any("testadmin/testlogin_details", ["uses"=>"AdminController@testlogin_details"]);

Route::any("admin/get_college_degree", ["uses"=>"AdminController@get_college_degree"]);

Route::any("admin/get_degree", ["uses"=>"AdminController@get_degree"]); 

Route::any("admin/get_college_branch", ["uses"=>"AdminController@get_college_branch"]);

Route::any("admin/get_branch", ["uses"=>"AdminController@get_branch"]);

Route::any("admin/get_degree_branch", ["uses"=>"AdminController@get_degree_branch"]);

Route::any("student/signup", ["uses"=>"AdminController@signup"]);

Route::any("student/submit_signup", ["uses"=>"AdminController@submit_signup"]);

Route::any("/setpassword", ["uses"=>"Auth\PasswordController@postPassword"]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
