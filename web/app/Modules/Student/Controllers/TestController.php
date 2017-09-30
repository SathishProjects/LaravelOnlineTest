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




class TestController extends Controller {   

    public function __construct(Store $session) {
        $this->session = $session;
       
    }
  
  public function testhome(Request $request,$id) 
    {

      // dd($this->session->all());

         $request['test_id'] = $id;

         $request['user_id'] = $this->session->get('user_authenticated.id');

         $request['student_id'] = $this->session->get('user_authenticated.reg_id');

        $API = App::make('APIService');
        
        $API->request('/student/create_test_login', "POST",$request->all());

       

    $testdetails = $API->responseJSON()->testdetails[0];
    
    $reappear_id = $API->responseJSON()->reappear_id;

        if(isset($API->responseJSON()->testdetails[0]->remember_question)){


            $this->session->set('user_authenticated.question_array',$API->responseJSON()->testdetails[0]->remember_question);

        }

        
            $responseJSON = Cache::rememberForever($id, function()  use ($id)

            {

                 $API = App::make('APIService');
        
                $API->request('/student/get_question_paper', "POST", ['test_id'=>$id] );


                return $API->responseJSON();

            });
       

    if($reappear_id){
      
            return view('admin.restart_test')->with('id',$id)->with('reappear_id',$reappear_id )->with('testdetails',$testdetails);
        }
        

       return view('admin.starttest')->with('id',$id)->with('testdetails',$testdetails);
    }  


    public function goto_test_details(Request $request,$id)
    {

   if(!$this->session->has('user_authenticated.id')){

        $user_details['message'] = "Sorry ! You have logged out of the test ... ";

        $user_details['input'] = 1;

       return view('student_feedback')->with('user_details',$user_details);
   }

   $request['user_id']= $this->session->get('user_authenticated.id');

   $request['test_id']= $id;

   $request['set_login'] = 1;
    
   $API = App::make('APIService');
   
   $API->request('/student/check_login', "POST",$request->all());

   if($API->responseJSON()->is_login){
      return redirect('/')->with('error', 'Sorry ! You have already attended the test ');
   }
   else{
       $user_id= $this->session->get('user_authenticated.id');

      $student_id= $this->session->get('user_authenticated.reg_id');
      
      return redirect('test_details/'.$id.'/1/1/'.$user_id.'/'.$student_id);
   }
    
    }


    public function test_details(Request $request,$id1,$id2,$id3,$id4,$id5)
    {
      
      

   if( !$this->session->get('user_authenticated.id') ){

      $API = App::make('APIService');
      $API->request('/admin/check_token', "POST",[$id4,$id5,$id1]);

      $remember_question = $API->responseJSON()->remember_question;
      
      $question_array = (json_decode($remember_question));

      $this->session->set('user_authenticated.question_array',$question_array);    

     

      if($API->responseJSON()->responseType == 'success'){

      $this->session->set('user_authenticated.token', $API->responseJSON()->token);
      $this->session->set('user_authenticated.id', $API->responseJSON()->user->id);
      $this->session->set('user_authenticated.reg_id', $API->responseJSON()->user->reg_id);
      $this->session->set('user_authenticated.user_type', $API->responseJSON()->user->user_type);
      $this->session->set('user_authenticated.email', $API->responseJSON()->user->email);
      $this->session->set('user_authenticated.name', $API->responseJSON()->user->name);
      }
      else{
      dd("Session expired in test page ");
          return redirect('testlogin/'.$id1);
      }
    }
  
   $request['test_id'] = $id1;
   $request['user_id'] = $id4;

  $API = App::make('APIService');
  $API->request('/student/test_question_details', "POST",$request->all());

  if($API->responseJSON()->status ==2 ){
    return redirect('/')->with('error', 'Sorry ! You have logged  out of the test ');
  }



  $cache_data = Cache::get($request['test_id']);

  $section_records= $cache_data->section_records ; 


  $finished_records=$API->responseJSON()->finished_records;

   $request['section_order_id'] = $id2;
   $request['qpq_order_id'] = $id3;

   
   $request['student_id'] = $id5;
   $request['reappear_id'] = 0;
   
   if($this->session->get('reappear_id')){
     $request['reappear_id'] = $this->session->get('reappear_id');  
    // $this->session->forget('reappear_id'); 
   }


   $question_array  = json_decode($this->session->get('user_authenticated.question_array'));



   foreach ($question_array as $key => $value) {
     
    if($key == $request['section_order_id']){
      $data = $value;
    }
   }
   
   
//dd([$request->all(),$id1,$id2,$id3,$id4,$id5]);

   $current_qpq_id = $data[$request['qpq_order_id']-1];

   $Question_records= $cache_data->Question_records;

   $Option_records= $cache_data->Option_records;

   $current_question_records = [];

   foreach ($Question_records as $qrkey => $qrvalue) {
    if($current_qpq_id == $qrvalue->qpq_id ){
      $current_question_records[0] = $Question_records[$qrkey];
    }
   }

  $current_option_records = [];

   foreach ($Option_records as $orkey => $orvalue) {
    if($current_qpq_id == $orvalue->qpq_id ){
      $current_option_records[] = $Option_records[$orkey];
    }
   }

   foreach ($cache_data->test_subjects as $subkey => $subvalue) {
      $subject[] = $subvalue->section_subject;
   }

  $key = array_search($current_question_records[0]->qpq_id, $data);

  $current_question_records[0]->qpq_order_id = $key+1;

  $ids= $cache_data->test_question_records[0];

  $ids->duration =  $API->responseJSON()->timetaken;

  $current_question_records[0]->response_qpqa_id = 0;

  foreach ($finished_records as $key => $value) {
      if( ($value->section_order_id==$current_question_records[0]->section_order_id) && ($value->qpq_order_id==$current_question_records[0]->qpq_order_id) ){
      $current_question_records[0]->response_qpqa_id = $value->response_qpqa_id;
      }
  }

   $tmp=[];
   $tmp1=[];
   $answered = 0;
//dd($current_question_records);
   foreach ($section_records as $skey => $svalue) {
       foreach ($finished_records as $fkey => $fvalue) {
      if(($svalue->section_id == $fvalue->section_id) && ($fvalue->status == 1)){
        $tmp[] = $fvalue->qpq_order_id;  
        $answered = $answered+1;
      }
      if(($svalue->section_id == $fvalue->section_id) && ($fvalue->status == null)){
        $tmp1[] = $fvalue->qpq_order_id;  
      }
       }

        $svalue->finished_questions = $tmp;$tmp=[];
        $svalue->notfinished_questions = $tmp1;$tmp1=[];
   }
    
    $subject_finished_count = 0;
    $subject_notfinished_count = 0;
    $subject_total_count = 0;
    $subject_finished_notfinished_count = [];
    
    foreach ($subject as $sbjkey => $sbjvalue) {
      foreach ($section_records as $srkey => $srvalue) {
        if($srvalue->section_subject == $sbjvalue){
          $subject_total_count = $subject_total_count + $srvalue->number_of_questions_section;
          
          if(count($srvalue->finished_questions)){
          $subject_finished_count = $subject_finished_count+count($srvalue->finished_questions);
          
          $subject_notfinished_count = $subject_notfinished_count + ($srvalue->number_of_questions_section - count($srvalue->finished_questions)) ;
          
          }
          else{
            $subject_notfinished_count = $subject_notfinished_count + $srvalue->number_of_questions_section ;
          }
        }
      }
      
      $subject_finished_notfinished_count[$sbjkey]['finished'] = $subject_finished_count;
       $subject_finished_notfinished_count[$sbjkey]['notfinished'] = $subject_notfinished_count;  
       $subject_finished_notfinished_count[$sbjkey]['total'] = $subject_total_count;  
      $subject_finished_count = 0;
      $subject_notfinished_count = 0; 
      $subject_total_count = 0; 
   }

   $this->session->set('time',1);

// dd($ids);
  
  return view('admin.testpage')
  ->with('subject',$subject)
     ->with('subject_finished_notfinished_count',$subject_finished_notfinished_count)
  ->with('section_records',$section_records)
  ->with('finished_records',$answered)
  ->with('current_question_records',$current_question_records)
  ->with('current_option_records',$current_option_records)
  ->with('ids',$ids);
    }


    public function submit_question(Request $request)
    {

  if(isset($request['response_qpqa_id'])){
   $request['status']=1;
  }

  $API = App::make('APIService');
  $API->request('/student/submit_question', "POST",$request->all());

//dd($API->responseJSON());
  $maximum_id=$API->responseJSON()->maximum_section_id[0]->id;

   $section = $API->responseJSON()->Section_records;

   
   foreach ($section as $key => $value) {
       
       if($value->section_id == $request['section_id']){

       if($request['qpq_order_id'] < $value->number_of_questions_section){
      $next_section =$request['section_order_id']; 
      $next_question=$request['qpq_order_id']+1;
       }
       else{
      if($request['section_id'] != $maximum_id){
      $next_section =$request['section_order_id']+1; 
      $next_question=1;   
      }
      else{
          $next_section =1; 
          $next_question=1;  
      }
       }

       }
   }   


  return redirect('test_details/'.$request['test_id'].'/'.$next_section.'/'.$next_question.'/'.$request['user_id'].'/'.$request['student_id']);
    }


    public function update_remaining_time(Request $request)
    {
        $API = App::make('APIService');
       $API->request('/student/update_remaining_time', "POST",$request->all() );

       return $API->responseJSON();
    }

    public function test_logout(Request $request,$id1,$id2) {

   $request['test_id'] = $id1;
   $request['batch_id'] = $id2;
   $request['user_id'] = $this->session->get('user_authenticated.id');
   $request['student_id'] = $this->session->get('user_authenticated.reg_id');
   $request['email'] = $this->session->get('user_authenticated.email');
   $request['name'] = $this->session->get('user_authenticated.name');

   $API = App::make('APIService');
   $API->request('/student/test/logout', "POST", $request->all()); 

    $user_details['test_id'] = $API->responseJSON()->data->test_id;
    $user_details['batch_id'] = $API->responseJSON()->data->batch_id;
    $user_details['user_id'] = $API->responseJSON()->data->user_id;
    $user_details['student_id'] = $API->responseJSON()->data->student_id;
    $user_details['email'] = $API->responseJSON()->data->email;
    $user_details['name'] = $API->responseJSON()->data->name;


   $user_details['message'] = "Thanks ! Contact Test Admin for test score";

   return view('student_feedback')->with('user_details',$user_details); 
    }

     public function student_feedback(Request $request)
    {
  
  $user_details = $request->all();

  $API = App::make('APIService');
  $API->request('/student/feedback', "POST",$request->all());

  $user_details['message'] = $API->responseJSON()->reponseMessage;

  $user_details['input'] = 1;

  return view('student_feedback')->with('user_details',$user_details);
    }

    public function restart_test(Request $request,$id1,$id2)
    {
   if(!$this->session->has('user_authenticated.id')){

        $user_details['message'] = "Sorry ! You have logged out of the test ... ";

        $user_details['input'] = 1;

       return view('student_feedback')->with('user_details',$user_details);
   }

   $request['user_id']= $this->session->get('user_authenticated.id');

   $request['test_id']= $id1;

   $request['set_login'] = 1;
   
   $this->session->set('reappear_id',$id2);
    
   $API = App::make('APIService');
   
   $API->request('/student/check_login', "POST",$request->all());

   if($API->responseJSON()->is_login){
      return redirect('/')->with('error', 'Sorry ! You have already attended the test ');
   }
   else{
       $user_id= $this->session->get('user_authenticated.id');

      $student_id= $this->session->get('user_authenticated.reg_id');
      
      return redirect('test_details/'.$id1.'/1/1/'.$user_id.'/'.$student_id);
   }
    
    }


}






