<?php


 
/** Auth Modules **/


Route::group([
    'module'    =>  'College',
    'namespace' =>  'App\Modules\College\Controllers'
], function(){




Route::get("/AddCollege", ["uses"=>"CollegeController@AddCollege"]);

Route::any("/college/submit_signup", ["uses"=>"CollegeController@submit_signup"]);

/* BATCH */

Route::get("create_batch", ["uses"=>"CollegeController@create_batch"]);

Route::get("{id}/college/edit_batch", ["uses"=>"CollegeController@edit_batch"]);

Route::any("/college/update_batch", ["uses"=>"CollegeController@update_batch"]);

Route::any("college/set_batch", ["uses"=>"CollegeController@set_batch"]);

Route::any("college/view_batch/{id}", ["uses"=>"CollegeController@view_batch"]);

Route::any("college/batchinstance/{id}", ["uses"=>"CollegeController@batchinstance"]);

/**/

/* TEST */

Route::get('/create_batch_instance/{id}','TestController@create_batch_instance');

Route::any('college/check_questionpaper','TestController@check_questionpaper');

Route::any('/starttest','TestController@starttest');

Route::any("college/viewstudents/{id}", ["uses"=>"TestController@admin_viewstudents"]);

Route::any("college/reappear_student", ["uses"=>"TestController@reappear_student"]);

Route::any("college/delete_test", ["uses"=>"TestController@delete_test"]);

Route::any('college/starttest','TestController@start_testinstance');

Route::any("college/endtest", ["uses"=>"TestController@endtest"]);

Route::any('college/download_batch_students/{id1}/{id2}','CollegeController@download_batch_students');
Route::any('college/download_batch_report/{id1}/{id2}','CollegeController@download_batch_report');

Route::any("college/export_test_feedback/{id}", ["uses"=>"CollegeController@export_test_feedback"]);

Route::any("college/export_test_report/{id}", ["uses"=>"CollegeController@export_test_report"]);



/**/

/*************ADMIN**********************/

Route::any("college/batch/{id}", ["uses"=>"CollegeController@batch_details"]);

Route::any("college/questionpaper/{id}", ["uses"=>"CollegeController@questionboard"]);

Route::get("create_question", ["uses"=>"CollegeController@create_question"]);

Route::any("college/set_questionpaper", ["uses"=>"CollegeController@set_questionpaper"]);

Route::get('{id}/college/set_section','CollegeController@set_section');

Route::any('college/add_section','CollegeController@add_section');

Route::get("{id1}/college/set_questions/{id2}/{id3}", ["uses"=>"CollegeController@set_question"]);

Route::get('{id}/college/edit_section','CollegeController@edit_section1');

Route::get('{id1}/college/edit_section/{id2}','CollegeController@edit_section');

Route::any('college/update_section','CollegeController@update_section');

Route::get("{id}/college/edit_questionpaper", ["uses"=>"CollegeController@edit_questionpaper"]);

Route::any("{id}/college/update_questionpaper", ["uses"=>"CollegeController@update_questionpaper"]);

Route::any('college/add_question','CollegeController@add_question');

Route::any('college/update_question','CollegeController@update_question');

Route::any("college/view_question_paper/{id}", ["uses"=>"CollegeController@view_question_paper"]);













});

?>