<?php namespace App\Modules\Student\Controllers;


use App;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Response;

use Cache;




class StudentController extends Controller {   

    public function __construct(Store $session) {
        $this->session = $session;
       
    }
  
public function signup($id)
{

	 $API = App::make('APIService');

     $API->request('/student/GetBatchById', "POST",$id);

     

     if(!count($API->responseJSON()->batch_details)){

     	 $this->session->set('error',"Sorry ! Invalid Batch id ");
     	 return redirect('/');
     }

    $batch_details = $API->responseJSON()->batch_details[0];

    return view('confirmation')->with('batch_details',$batch_details);
}

public function student_register(Request $request)
    {


         $API = App::make('APIService');

         $API->request('/student/get_signup_details', "POST", $request->all());

         $board_records = $API->responseJSON()->board_records;

         $medium_records = $API->responseJSON()->medium_records;

         $degree_records = $API->responseJSON()->degree_records;

         $state_records = $API->responseJSON()->state_records;

       return view('student.student_register')

       ->with('college_id',$request['college_id'])
       ->with('college_name',$request['college_name'])
       ->with('board_records',$board_records)
       ->with('medium_records',$medium_records)
       ->with('degree_records',$degree_records)
       ->with('state_records',$state_records)

       ->with('qualification',$request['qualification'])
       ->with('batch_details',$request->all());
    }

public function submit_signup(Request $request)
    {

      $time = strtotime($request['date_of_birth']);

      $request['date_of_birth'] = date('Y-m-d',$time);
			

	$API = App::make('APIService');

	$API->request('/student/submit_signup', "POST", $request->all());


	 if($API->responseJSON()->responseType == 'success'){

	 	return redirect('/')->with('message', $API->responseJSON()->reponseMessage);
	 }
	 else{
	 	return redirect('/')->with('error', $API->responseJSON()->reponseMessage);
	 }

    }    

public function dashboard()
    {
        $student_id = $this->session->get('user_authenticated.reg_id');

        $API = App::make('APIService');

        $API->request('/student/dashboard_details', "POST", $student_id);

        // dd($API->responseJSON());

        $user = $this->session->get('user_authenticated');

        $data = $API->responseJSON()->user;

        return view('student.dashboard')->with('user',$user)->with('data',$data);
    }    

}






