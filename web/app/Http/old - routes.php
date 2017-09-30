<?php

 
/** Auth Modules **/
Route::get("/", ["uses"=>"Auth\AuthController@viewLogin"]);

Route::get("/signup", ["uses"=>"Auth\AuthController@signup"]);

/** Get General records **/

Route::any("/get_district", ["uses"=>"Auth\AuthController@get_district"]);

Route::any("/get_multiple_district", ["uses"=>"Auth\AuthController@get_multiple_district"]);

Route::any("/get_city", ["uses"=>"Auth\AuthController@get_city"]);

Route::any("/get_branch", ["uses"=>"Auth\AuthController@get_branch"]);

Route::any("/get_ug_branch", ["uses"=>"Auth\AuthController@get_ug_branch"]);

Route::any("/get_multiple_branch", ["uses"=>"Auth\AuthController@get_multiple_branch"]);


Route::any("/get_venue_college", ["uses"=>"Auth\AuthController@get_venue_college"]);
Route::any("/get_invited_college", ["uses"=>"Auth\AuthController@get_invited_college"]);

/**  **/



Route::get("/home", ["uses"=>"Auth\AuthController@viewLogin1"]);

Route::get("/download_college_students", ["uses"=>"Auth\AuthController@download_college_students"]);

Route::any("/download_record", ["uses"=>"AdminController@download_record"]);

Route::get('/create_batch_instance/{id}','Auth\AuthController@create_batch_instance');

Route::any("test/submit_question", ["uses"=>"Auth\AuthController@submit_question"]);


Route::any("admin/update_test_duration", ["uses"=>"Auth\AuthController@update_test_duration"]);

Route::post('/starttest','Auth\AuthController@starttest');

Route::any("test_details/{id1}/{id2}/{id3}/{id4}/{id5}", ["uses"=>"Auth\AuthController@test_details"]);

Route::any("goto_test_details/{id1}", ["uses"=>"Auth\AuthController@goto_test_details"]);

Route::any("restart_test/{id1}/{id2}", ["uses"=>"Auth\AuthController@restart_test"]);

Route::any("/testlogin/{id}", ["uses"=>"Auth\AuthController@testlogin"]);

Route::any("testadmin/logout", ["uses"=>"Auth\AuthController@testadmin_logout"]);

Route::any("testadmin/feedback", ["uses"=>"Auth\AuthController@testadmin_feedback"]);

Route::any("student/feedback", ["uses"=>"Auth\AuthController@student_feedback"]);

Route::any("admin/batch/{id}", ["uses"=>"AdminController@index"]);

Route::any("admin/questionpaper/{id}", ["uses"=>"AdminController@questionboard"]);

Route::get("create_question", ["uses"=>"AdminController@create_question"]);

Route::get("{id}/admin/edit_questionpaper", ["uses"=>"AdminController@edit_questionpaper"]);

Route::post("{id}/admin/update_questionpaper", ["uses"=>"AdminController@update_questionpaper"]);

Route::post("admin/set_questionpaper", ["uses"=>"AdminController@set_questionpaper"]);

Route::post("get_chapter", ["uses"=>"AdminController@get_chapter"]);

Route::get('{id}/admin/set_section','AdminController@set_section');

Route::get('{id}/admin/edit_section','AdminController@edit_section1');

Route::get('{id1}/admin/edit_section/{id2}','AdminController@edit_section');

Route::post('admin/add_section','AdminController@add_section');

Route::post('admin/update_section','AdminController@update_section');

Route::post('admin/delete_section','AdminController@delete_section');

Route::get("{id1}/admin/set_questions/{id2}/{id3}", ["uses"=>"AdminController@set_question"]); 

Route::post('admin/add_question','AdminController@add_question');

Route::post('admin/update_question','AdminController@update_question');

Route::post('admin/delete_option','AdminController@delete_option');

Route::post('admin/check_questionpaper','AdminController@check_questionpaper');

Route::post('admin/update_remaining_time','AdminController@update_remaining_time');

/** Create Test  **/

Route::get("create_batch", ["uses"=>"AdminController@create_batch"]);


Route::post("admin/set_batch", ["uses"=>"AdminController@set_batch"]);

Route::post("/admin/update_batch", ["uses"=>"AdminController@update_batch"]);

Route::post("{id}/admin/updatetest_status", ["uses"=>"AdminController@updatetest_status"]);

Route::get('{id}/admin/assign_questionpaper','AdminController@assign_questionpaper');

Route::get("{id}/admin/edit_batch", ["uses"=>"AdminController@edit_batch"]);

Route::get('{id}/admin/update_assigned_questionpaper','AdminController@update_assigned_questionpaper');

Route::any("admin/view_batch/{id}", ["uses"=>"AdminController@view_batch"]);

Route::any("admin/view_question_paper/{id}", ["uses"=>"AdminController@view_question_paper"]);

Route::get("testpage/{id}", ["uses"=>"AdminController@testpage"]);

Route::any("testhome/{id}", ["uses"=>"AdminController@testhome"]);

Route::any("test_data/{id1}/{id2}/{id3}", ["uses"=>"AdminController@test_data"]);

Route::any("admin/testkey/{id}", ["uses"=>"AdminController@testkey"]);

Route::any("admin/batchinstance/{id}", ["uses"=>"AdminController@batchinstance"]);

Route::any("admin/testreport/{id}", ["uses"=>"AdminController@testreport"]);

Route::any("admin/full_testreport/{id}", ["uses"=>"AdminController@full_testreport"]);

Route::any("admin/export_testreport/{id}", ["uses"=>"AdminController@export_testreport"]);

Route::any("admin/export_fulltestreport/{id}", ["uses"=>"AdminController@export_fulltestreport"]);

Route::any("admin/download_college_students/{id}", ["uses"=>"AdminController@download_college_students"]);

Route::any("admin/download_all_college_students/{id}", ["uses"=>"AdminController@download_all_college_students"]);

Route::any("admin/export_feedback/{id}", ["uses"=>"AdminController@export_feedback"]);

Route::any("admin/individual_testreport/{id1}/{id2}", ["uses"=>"AdminController@individual_testreport"]);

Route::any("admin/endtestinstance/{id1}", ["uses"=>"AdminController@endtestinstance"]);


Route::any("testlogin_admin/{id}", ["uses"=>"AdminController@testlogin_admin"]);

Route::any("testadmin/starttest", ["uses"=>"AdminController@testadmin_starttest"]);

Route::any("testadmin/endtest", ["uses"=>"AdminController@testadmin_endtest"]);

Route::any("testadmin/delete_test", ["uses"=>"AdminController@admin_delete_test"]);

Route::any("testadmin/reappear_student", ["uses"=>"AdminController@reappear_student"]);

Route::any("testadmin/testreport/{id}", ["uses"=>"AdminController@testadmin_testreport"]);

Route::any("testadmin/viewstudents/{id}", ["uses"=>"AdminController@testadmin_viewstudents"]);

Route::any("admin/viewstudents/{id}", ["uses"=>"AdminController@admin_viewstudents"]);

Route::any("student/new_signup", ["uses"=>"Auth\AuthController@new_signup"]);

Route::any("student/dashboard", ["uses"=>"Auth\AuthController@dashboard"]);

Route::any("admin/get_college_degree", ["uses"=>"Auth\AuthController@get_college_degree"]);

Route::any("admin/get_degree", ["uses"=>"Auth\AuthController@get_degree"]);

Route::any("admin/get_college_branch", ["uses"=>"Auth\AuthController@get_college_branch"]);

Route::any("admin/get_branch", ["uses"=>"Auth\AuthController@get_branch"]);

Route::any("admin/get_degree_branch", ["uses"=>"Auth\AuthController@get_degree_branch"]);

Route::any("submit_signup", ["uses"=>"Auth\AuthController@submit_signup"]);

/** Joseph  **/

Route::get("page1", ["uses"=>"AdminController@page1"]);
Route::get("page3", ["uses"=>"AdminController@page3"]);
Route::get("page4", ["uses"=>"AdminController@page4"]);



/** User Authentication **/
Route::post("auth/login", ["uses"=>"Auth\AuthController@login"]);

Route::post("auth/testlogin/check", ["uses"=>"Auth\AuthController@testlogin_check"]);

Route::get("auth/logout", ["uses"=>"Auth\AuthController@logout"]);

Route::any("test/logout/{id1}", ["uses"=>"Auth\AuthController@test_logout"]);

?>