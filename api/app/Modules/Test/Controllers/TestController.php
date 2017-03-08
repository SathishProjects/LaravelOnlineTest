<?php namespace App\Modules\Test\Controllers;



use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;




class TestController extends Controller {   

    public function __construct() {
	     
    }
	
public function test()
{
	return "I m working";
}

}






