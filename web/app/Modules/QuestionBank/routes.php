<?php


 
/** Auth Modules **/


Route::group([
    'module'    =>  'QuestionBank',
    'namespace' =>  'App\Modules\QuestionBank\Controllers'
], function(){








Route::get("/QuestionBank", "QuestionBankController@test");













});

?>