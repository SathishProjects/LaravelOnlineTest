<?php namespace App\Http\Controllers;

use App;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyFormRequest;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

use Maatwebsite\Excel\Facades\Excel;

use Cache;

class AdminController extends Controller {

    /**
    * Middleware handles the request
    */
    public function __construct(Store $session) {
    }


    

    
}