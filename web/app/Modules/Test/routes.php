<?php


 
/** Auth Modules **/


Route::group([
    'module'    =>  'Test',
    'namespace' =>  'App\Modules\Test\Controllers'
], function(){








Route::get("/test", "TestController@test");













});

?>