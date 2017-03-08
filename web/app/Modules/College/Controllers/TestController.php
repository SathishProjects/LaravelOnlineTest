<?php namespace App\Modules\College\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Response;

use Cache;




class TestController extends Controller {   

    public function __construct(Store $session) {
        $this->session = $session;
       
    }
  
      public function create_batch_instance($id)
    {

        $API = App::make('APIService');
        $API->request('/get_batch_degree_details', "POST",$id);

        $batch_details = $API->responseJSON()->batch_details;
            
        return view('create_batch_instance')->with('batch_details',$batch_details);
    

    
    }

    public function check_questionpaper(Request $request)
    {

        $request['college_id'] = $this->session->get('user_authenticated.reg_id');

        $API = App::make('APIService');
        $API->request('/college/check_questionpaper', "POST", $request->all());

        $details = $API->responseJSON()->record;
       
        if($details){
            return $details;     
        }
        else{
            return ["Failed"];
        }
        
    }

    public function starttest(Request $request)
    {

     $request['college_id'] = $this->session->get('user_authenticated.reg_id');

        
     $API = App::make('APIService');
     $API->request('/testadmin/assign_starttest', "POST",$request->all());

     $responseType = $API->responseJSON()->responseType;
     $reponseMessage = $API->responseJSON()->reponseMessage;
    
     if($responseType == 'success'){

        $this->session->set('message', $reponseMessage);

        return redirect('/college/batchinstance/'.$request['batch_id'] );

     }
     else{

        $this->session->set('message', $reponseMessage);

        return redirect('/college/view_batch/'.$request['batch_id'] );
     }

     
    }

    public function admin_viewstudents(Request $request,$id)
    {

        $college_id = ($this->session->get('user_authenticated.reg_id'));

       $API = App::make('APIService');
       $API->request('/college/viewstudents', "POST",['test_id'=>$id,"college_id"=>$college_id]);
        
        // dd($API->responseJSON());
       
       if($API->responseJSON()->responseType == 'success'){
       $testdetails = $API->responseJSON()->test_details[0];
       $student_details_list = $API->responseJSON()->student_details;

       // dd($testdetails->title);

       return view('admin.admin_view_students')->with('testdetails',$testdetails)->with('student_details_list',$student_details_list);
        }
       else{

            $details['responseType'] = $API->responseJSON()->responseType;
            $details['reponseMessage'] = $API->responseJSON()->reponseMessage;

            return redirect('/')->with('error', $API->responseJSON()->reponseMessage);
       }
    }

    public function reappear_student(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/college/reappear_student', "POST",$request->all());

        // dd($API->responseJSON());

        $data = (array)$API->responseJSON()->reponseMessage;    

        return $data;
    }

    public function delete_test(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/college/delete_test', "POST",$request->all()); 
        $data = (array)$API->responseJSON()->reponseMessage;    

        return $data;
    }

    public function start_testinstance(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/college/starttest', "POST",$request->all()); 
        $data = (array)$API->responseJSON()->reponseMessage;    

        return $data;
    }

    public function endtest(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/college/endtest', "POST",$request->all());

        $data = (array)$API->responseJSON()->reponseMessage;    

        return $data;
    }





}






