<?php namespace App\Http\Controllers\Auth;

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

class AuthController extends Controller {                                                                       

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
    |--------------------------------------------------------------------------
    | API URL needs to be set in this property
    |--------------------------------------------------------------------------
    */
    private $_API = null;

    /**
     * Store Object
     * @var Session
     */
    protected $session;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar, Store $session) {
	     
			$this->auth = $auth;
	     $this->registrar = $registrar;
	     $this->session = $session;
	     $this->_API = Config::get('app.API');
	     $this->middleware('guest', ['except' => 'new_signup','get_test_password','get_college_branch','get_college_degree','test_details','submit_question','getLogout', 'starttest','testlogin','testadmin_logout','testadmin_feedback','student_feedback','goto_test_details']);
    }


    /** Get General records **/

    public function get_district(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_district', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_multiple_district(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_multiple_district', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_city(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_city', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_branch(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_branch', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_ug_branch(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_ug_branch', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_multiple_branch(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_multiple_branch', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_venue_college(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_venue_college', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_invited_college(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_invited_college', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    /**  **/
	
	/**
     * Sathish
     * Login dropdown datas
     */
	 
	public function viewLogin()
    {
	 if($this->session->has('user_authenticated') && $this->session->get('user_authenticated.id') == 1){
	     $redirectURL = 'admin/batch/active';        
	 return redirect($redirectURL);
	 }
		return view('landing_page');
    }

    public function signup()
    {
    	return view('confirmation');
    }

    public function student_register(Request $request)
    {

    	dd($request->all());

         $API = App::make('APIService');

         $API->request('/student/get_signup_details', "POST", $request->all());
         
         $board_records = $API->responseJSON()->board_records;

         $medium_records = $API->responseJSON()->medium_records;

         $degree_records = $API->responseJSON()->degree_records;

         $state_records = $API->responseJSON()->state_records;

         $college_records = $API->responseJSON()->college_records;

       return view('student.student_register')

       ->with('board_records',$board_records)
       ->with('medium_records',$medium_records)
       ->with('degree_records',$degree_records)
       ->with('state_records',$state_records)
       ->with('college_records',$college_records)

       ->with('qualification',$request['qualification']);
    }
	
	public function download_college_students()
    {
	 $API = App::make('APIService');
	 $API->request('/admin/get_college');
		
		$college_list = $API->responseJSON()->college_list;
		
		  return view('admin.download_college_students')->with('college_list',$college_list);
    }
	
	

    public function viewLogin1()
    {
	 if($this->session->has('user_authenticated') && $this->session->get('user_authenticated.id') == 1){
	     $redirectURL = 'admin/batch/active';        
	 return redirect($redirectURL);
	 }

	 return view('login');
    }

    public function create_batch_instance($id)
    {

    	$API = App::make('APIService');
	 	$API->request('/get_batch_degree_details', "POST",$id);

	 	$batch_details = $API->responseJSON()->batch_details;
    		
	    return view('create_batch_instance')->with('batch_details',$batch_details);
	

	
    }

    public function starttest(Request $request)
    {

	 $API = App::make('APIService');
	 $API->request('/testadmin/assign_starttest', "POST",$request->all());

	 $responseType = $API->responseJSON()->responseType;
	 $reponseMessage = $API->responseJSON()->reponseMessage;
	
	 if($responseType == 'success'){

	 	$this->session->set('message', $reponseMessage);

	 	return redirect('/admin/batchinstance/'.$request['batch_id'] );

	 }
	 else{

		$this->session->set('message', $reponseMessage);

	 	return redirect('/admin/view_batch/'.$request['batch_id'] );
	 }

	 
    }


    public function testadmin_logout(Request $request)
    {

	 $API = App::make('APIService');
	 $API->request('/admin/testadmin_logout', "POST",$request->all());

	 $user_details['test_id'] = $API->responseJSON()->test_id;
	 $user_details['test_id'] = $request['test_id'];

	 if($API->responseJSON()->responseType == 'Success'){
	     return view('admin_feedback')->with('user_details',$user_details);
	 }
	 else{
	     return redirect('/testlogin/'.$request['test_id'] )
	     ->with('errortype', 'admin')
	     ->with('error', $API->responseJSON()->reponseMessage);
	 }
    }


    /**
     * Login Authentication with email & password
     * @param Request $request
     */
    public function login(Request $request) {

	 if(!isset($request['id'])){
	     $request['id'] = null;
	 }

	 try {
	     $API = App::make('APIService');
			
	     $API->request('/auth/login', "POST", [ 
		  'email'     => $request->get('email'), 
		  'password'  => $request->get('password'),
		  'test_id'  => $request->get('id')

	     ]);

	     

			if (200 == $API->responseStatusCode()) {
				
		  if(isset($API->responseJSON()->error) && isset($API->responseJSON()->errortype) ){

		      return redirect('/')->with('error', $API->responseJSON()->error)->with('errortype', $API->responseJSON()->errortype);

		  }
		  elseif(isset($API->responseJSON()->error)){

		      return redirect('/')->with('error', $API->responseJSON()->error);
		  }
				
				$this->session->set('user_authenticated.token', $API->responseJSON()->token);
		  $this->session->set('user_authenticated.id', $API->responseJSON()->user->id);
		  $this->session->set('user_authenticated.reg_id', $API->responseJSON()->user->reg_id);
		  $this->session->set('user_authenticated.user_type', $API->responseJSON()->user->user_type);
		  $this->session->set('user_authenticated.email', $API->responseJSON()->user->email);
		  $this->session->set('user_authenticated.name', $API->responseJSON()->user->name);
				
				$usertype = $this->session->get('user_authenticated.user_type');
				$id = $this->session->get('user_authenticated.id');
				
				if($usertype == 4 && $id == 101){
					$redirectURL = 'admin/batch/active';
					return redirect($redirectURL);
				}
		 
				else if($this->session->get('user_authenticated.user_type') == 1) {

					$this->session->set('user_authenticated.batch',$API->responseJSON()->user->batch);
					$this->session->set('user_authenticated.test_details',$API->responseJSON()->user->test_details);

		      		return redirect('student/dashboard');
		      
				}
				else{
					return redirect('/')->with('error', 'Sorry ! No login access except Test Engine Admin');
				}
	     }
	 }
	 catch(\GuzzleHttp\Exception\ClientException $exception) {
	     return redirect('/')->with('error', 'Username or password incorrect ! Try Again')->with('errortype',1);
	 }
    }

    public function dashboard()
    {
    	$user = $this->session->get('user_authenticated');

    		unset($user['token']);

    	return view('student.dashboard')->with('user',$user);
    }

    public function testlogin(Request $request,$id)
    {
	 $API = App::make('APIService');
	 $API->request('/auth/check_test_login_id', "POST",$id);

	     return redirect('/testhome/'.$id);
	
	 
    }

     public function testlogin_check(Request $request)
    {
	
	$login_type = $request['login_type'];
	$test_id = $request['id'];

	 $API = App::make('APIService');
	$API->request('/student/testlogin_check', "POST",$request->all());

	if($API->responseJSON()->responseType == "failure"){
		 return redirect('/')->with('error', $API->responseJSON()->reponseMessage);
	}

	if($API->responseJSON()->test_status == 1){
		if($API->responseJSON()->college_match == 1){
			if($API->responseJSON()->degree_match == 1){
				if($API->responseJSON()->branch_match == 1){
					
					if($API->responseJSON()->year_match == 1){
					
					$request['test_name']=$API->responseJSON()->test_name;
					
					return view('get_test_password')->with('credentials',$request->all());
					
					}
					else{
	     			return redirect('/')->with('error', 'Sorry ... Test not assigned to your batch yet');
					}
	     		}
	     		else{
	     			return redirect('/')->with('error', 'Sorry ... Test not assigned to your branch yet');
	 			}
	     	}
	     	else{
	     			return redirect('/')->with('error', 'Sorry ... Test not assigned to your degree yet');
	 			}
	 	}
	 	else{
	     			return redirect('/')->with('error', 'Sorry ... Test not assigned to your College');
	 			}
	 }
	 elseif($API->responseJSON()->test_status == 2){

	     return redirect('/')->with('error', 'Sorry ! Test Finished ... ');
	 }
	 elseif($API->responseJSON()->test_status == 3 || $API->responseJSON()->test_status == 0){
	     return redirect('/')->with('error', 'Sorry ... Test Not Active ! Try Again Later');
	 }
	 elseif($API->responseJSON()->test_status == 4){
			
		$testlogin_details = $API->responseJSON()->testlogin_details;
		
		if(isset($testlogin_details->degree_type[0])){
		$testlogin_details->degree_type = $testlogin_details->degree_type[0];
		}
		else{
			return redirect('/')->with('error', 'Sorry ... Provide Test id of your branch');
		}
		
	    return view('confirmation')->with('testlogin_details',$testlogin_details)->with('email',$request['email']);
	 }

    }

    public function new_signup(Request $request)
    {

    	$request['other_degree'] = explode(',', $request['other_degree']);
    	$API = App::make('APIService');
		$API->request('/student/signup', "POST",$request->all());
 //dd($API->responseJSON());
		$degree =  $API->responseJSON()->degree;

		$selected_degree_details =  $API->responseJSON()->selected_degree_details;

		$languge_details =  $API->responseJSON()->languge_details;

		$university_details =  $API->responseJSON()->university_details;
		
		$request['year'] = $API->responseJSON()->data->test_year;
		
    	return view('candidate_signup')
    	->with('details',$request->all())
    	->with('degree',$degree)
    	->with('selected_degree_details',$selected_degree_details)
    	->with('languge_details',$languge_details)
    	->with('university_details',$university_details);
    }

    public function submit_signup(Request $request)
    {
			
		if(isset($request['new_institution']) && isset($request['UG1_institution']) && $request['UG1_institution'] == 99999){
			$request['UG1_institution'] = $request['new_institution'];
			$request['new_institution'] = 1;
		}
		
		if(isset($request['new_institution']) && isset($request['PG1_institution'])  && $request['PG1_institution'] == 99999){
			$request['PG1_institution'] = $request['new_institution'];
			$request['new_institution'] = 1;
		}
		dd($request->all());
	$API = App::make('APIService');
	 $API->request('/student/submit_signup', "POST", $request->all());

	 if($API->responseJSON()->responseType == 'success'){
	 $test_id = $API->responseJSON()->test_id;
	 $email_id = $API->responseJSON()->email_id;

	 try {
	     $API = App::make('APIService');
			
	     $API->request('/auth/login', "POST", [
		  'email'     => $email_id, 
		  'password'  => '12345678',
		  'test_id'  => $test_id

	     ]);

	     
			if (200 == $API->responseStatusCode()) {
				
		  if(isset($API->responseJSON()->error) && isset($API->responseJSON()->errortype) ){

		      return redirect('/')->with('error', $API->responseJSON()->error)->with('errortype', $API->responseJSON()->errortype);

		  }
		  elseif(isset($API->responseJSON()->error)){

		      return redirect('/')->with('error', $API->responseJSON()->error);
		  }
				
				$this->session->set('user_authenticated.token', $API->responseJSON()->token);
		  $this->session->set('user_authenticated.id', $API->responseJSON()->user->id);
		  $this->session->set('user_authenticated.reg_id', $API->responseJSON()->user->reg_id);
		  $this->session->set('user_authenticated.user_type', $API->responseJSON()->user->user_type);
		  $this->session->set('user_authenticated.email', $API->responseJSON()->user->email);
				$this->session->set('user_authenticated.name', $API->responseJSON()->user->name);
				
				$usertype = $this->session->get('user_authenticated.user_type');
				$id = $this->session->get('user_authenticated.id');
				
				if($usertype == 4 && $id == 101){
					$redirectURL = 'admin/batch/active';
					return redirect($redirectURL);
				}
		  else if($this->session->get('user_authenticated.user_type') == 2) {
		      
			return redirect('/testlogin_admin/'.$test_id);
		  }
				else if($this->session->get('user_authenticated.user_type') == 1) {

		      		return redirect('testhome/'.$test_id);
		      
				}
				else{
					return redirect('/')->with('error', 'Sorry ! No login access except Test Engine Admin');
				}
	     }
	 }
	 catch(\GuzzleHttp\Exception\ClientException $exception) {
	     
	     return redirect('/')->with('error', 'Username or password incorrect ! Try Again');
	 }

	 }
	 else{
	 	return redirect('/')->with('error', $API->responseJSON()->reponseMessage);
	 }

    }

    /**
     * Logging Out the user
     * @return type
     */
    public function logout() {
	 $this->session->flush(); 
	 return redirect('/')->with('error', 'Successfully Logged out');
    }

    public function test_logout(Request $request,$id1) {

	 $request['test_id'] = $id1;
	 $request['user_id'] = $this->session->get('user_authenticated.id');
	 $request['student_id'] = $this->session->get('user_authenticated.reg_id');
	 $request['email'] = $this->session->get('user_authenticated.email');
	 $request['name'] = $this->session->get('user_authenticated.name');

	 $API = App::make('APIService');
	 $API->request('/admin/test/logout', "POST", $request->all()); 

	 $is_logout = $API->responseJSON()->is_logout;
	 $request['test_id'] = $API->responseJSON()->test_id;
	 $request['result'] = $API->responseJSON()->result;
	 $request['total'] = $API->responseJSON()->total;

	 $session_id = $this->session->get('test_id');

	 if(!$session_id){

	 $this->session->flush();

	 $this->session->set('test_id',$request['test_id']);
	 $this->session->set('user_id',$request['user_id']);
	 $this->session->set('student_id',$request['student_id']);
	 $this->session->set('email',$request['email']);
	 $this->session->set('name',$request['name']);

	 $this->session->set('test_id',$request['test_id']);
	 $this->session->set('result',$request['result']);
	 $this->session->set('total',$request['total']);

	}

		$user_details['test_id'] = $this->session->get('test_id');
		$user_details['user_id'] = $this->session->get('user_id');
		$user_details['student_id'] = $this->session->get('student_id');
		$user_details['email'] = $this->session->get('email');
		$user_details['name'] = $this->session->get('name');

		$user_details['test_id'] = $this->session->get('test_id');
		$user_details['result'] = $this->session->get('result');
		$user_details['total'] = $this->session->get('total');

	 $user_details['message'] = "Thanks ! Contact Test Admin for detail test report";

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

    public function testadmin_feedback(Request $request)
    {
	   
	$user_details = $request->all();

	$API = App::make('APIService');
	$API->request('/testadmin/feedback', "POST",$request->all());

	$this->session->set('message',$API->responseJSON()->reponseMessage);
	  
	return redirect('testlogin_admin/'.$request['test_id']);
    }


     public function update_test_duration(Request $request)
    {
	 $this->session->set('remaining_time',$request['remaining_time']);

	 return $request['remaining_time'];
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
	 
	 $API->request('/admin/check_login', "POST",$request->all());

	 if($API->responseJSON()->is_login){
		  return redirect('/')->with('error', 'Sorry ! You have already attended the test ');
	 }
	 else{
		   $user_id= $this->session->get('user_authenticated.id');

		  $student_id= $this->session->get('user_authenticated.reg_id');
		  
		  return redirect('test_details/'.$id.'/1/1/'.$user_id.'/'.$student_id);
	 }
	  
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
	 
	 $API->request('/admin/check_login', "POST",$request->all());

	 if($API->responseJSON()->is_login){
		  return redirect('/')->with('error', 'Sorry ! You have already attended the test ');
	 }
	 else{
		   $user_id= $this->session->get('user_authenticated.id');

		  $student_id= $this->session->get('user_authenticated.reg_id');
		  
		  return redirect('test_details/'.$id1.'/1/1/'.$user_id.'/'.$student_id);
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
	$API->request('/admin/test_question_details', "POST",$request->all());


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
	$API->request('/admin/submit_question', "POST",$request->all());

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


    public function get_college_degree(Request $request)
    {
	
	//$request['institution_id'] = implode(',',$request['institution_id']);
		
	$API = App::make('APIService');
	$API->request('/admin/get_college_degree', "POST",$request->all());

	$ug = $API->responseJSON()->degree_list->ug;

	$pg = $API->responseJSON()->degree_list->pg;

	$diploma = $API->responseJSON()->degree_list->diploma;

	$data = ['ug'=>$ug,'pg'=>$pg,'diploma'=>$diploma];    

        return $data;


    }
	
	public function get_degree(Request $request)
    {
	
	$API = App::make('APIService');
	$API->request('/admin/get_degree', "POST",$request->all());
//dd($API->responseJSON());
	$ug = $API->responseJSON()->degree_list->ug;

	$pg = $API->responseJSON()->degree_list->pg;

	$diploma = $API->responseJSON()->degree_list->diploma;

	$data = ['ug'=>$ug,'pg'=>$pg,'diploma'=>$diploma];    

        return $data;


    }

    public function get_college_branch(Request $request)
    {
    	
	$API = App::make('APIService');
	$API->request('/admin/get_college_branch', "POST",$request->all());

	$data = [$API->responseJSON()];    

        return $data;


    }
/*
	public function get_branch(Request $request)
    {
    	
	$API = App::make('APIService');
	$API->request('/admin/get_branch', "POST",$request->all());

	$data = [$API->responseJSON()];     

        return $data;


    }

    public function get_degree_branch(Request $request)
    {

    	
	$API = App::make('APIService');
	$API->request('/admin/get_degree_branch', "POST",$request->all());

	$data = [$API->responseJSON()];    

        return $data;


    }*/



}
