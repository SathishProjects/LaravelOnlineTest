<?php


 
/** Auth Modules **/


Route::group([
    'module'    =>  'Admin',
    'namespace' =>  'App\Modules\Admin\Controllers'
], function(){








Route::get("/Admin", "AdminController@test");













});

?>