<?php


 
/** Auth Modules **/


Route::group([
    'module'    =>  'College',
    'namespace' =>  'App\Modules\College\Controllers'
], function(){



Route::get("/college/get_collegesignup_details", "CollegeController@get_collegesignup_details");

Route::any("/college/submit_signup", "CollegeController@submit_signup");

Route::any("college/dashboard_batch_details", ["uses"=>"CollegeController@dashboard_batch_details"]);

Route::post("college/dashboard_questionpaper_details", ["uses"=>"CollegeController@dashboard_questionpaper_details"]);

Route::post("college/set_questionpaper", ["uses"=>"CollegeController@set_questionpaper"]);

Route::any("college/get_questionpaper_detail", ["uses"=>"CollegeController@get_questionpaper_detail"]);

Route::any("college/get_questionpaper_detail2", ["uses"=>"CollegeController@get_questionpaper_detail2"]);

Route::post("college/get_section_chapter", ["uses"=>"CollegeController@get_section_chapter"]);

Route::post('college/add_section','CollegeController@add_section');

Route::post('college/update_section','CollegeController@update_section');

Route::post("college/edit_questionpaper", ["uses"=>"CollegeController@edit_questionpaper"]);

Route::post("college/update_questionpaper", ["uses"=>"CollegeController@update_questionpaper"]);

Route::post('college/add_question','CollegeController@add_question');

Route::post('college/update_question','CollegeController@update_question');

/* IMAGE UPLOAD */

Route::post('college/set_question_option_image_url','CollegeController@set_question_option_image_url');

Route::post('college/update_section_image_url','CollegeController@update_section_image_url');

Route::post('college/update_question_image_url','CollegeController@update_question_image_url');

Route::post('college/update_option_image_url','CollegeController@update_option_image_url');

/**/

Route::post("college/view_question_paper", ["uses"=>"CollegeController@view_question_paper"]);

Route::post("college/get_option_details", ["uses"=>"CollegeController@get_option_details"]);

Route::post("college/set_batch", ["uses"=>"CollegeController@set_batch"]);

/**/

Route::post("college/view_batch_details", ["uses"=>"CollegeController@view_batch_details"]); 

Route::post("college/batchinstance", ["uses"=>"CollegeController@batchinstance"]);

Route::post("college/edit_batch", ["uses"=>"CollegeController@edit_batch"]);

Route::post("college/update_batch", ["uses"=>"CollegeController@update_batch"]);

Route::post("college/export_test_feedback", ["uses"=>"CollegeController@export_test_feedback"]);

Route::post("college/export_test_report", ["uses"=>"CollegeController@export_test_report"]);

/**/


/**/

Route::any("/get_batch_degree_details", ["uses"=>"TestController@get_batch_degree_details"]);

Route::post("college/check_questionpaper", ["uses"=>"TestController@check_questionpaper"]);

Route::any("testadmin/assign_starttest", ["uses"=>"TestController@assign_starttest"]);

Route::any("college/viewstudents", ["uses"=>"TestController@admin_viewstudents"]);

Route::any("college/reappear_student", ["uses"=>"TestController@reappear_student"]);

Route::any("college/delete_test", ["uses"=>"TestController@delete_test"]);

Route::any("college/starttest", ["uses"=>"TestController@starttest"]);

Route::post("college/download_batch_students", ["uses"=>"TestController@download_batch_students"]);

Route::post("college/download_batch_report", ["uses"=>"TestController@download_batch_report"]);

Route::post("college/endtest", ["uses"=>"TestController@endtest"]);



/**/










});

?>