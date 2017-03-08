<?php namespace App\Http\Controllers\Auth;

use JWTAuth;
use App\User;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\StudentTestLoginMaster;
use App\TestLoginMaster;
use App\TestResponseMaster;
use App\BatchMaster;
use App\SectionMaster;
use App\QuestionPaperQuestionsMaster;


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
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
       /* $this->middleware('auth', ['except' => ['check_test_eligible','postLogin', 'viewLogin','test_logout','check_test_id','check_test_login_id']]);*/
    }

    /**
     * Overriding the postLogin logic
     * @param \App\Http\Controllers\Auth\Request $request
     * @param \App\Http\Controllers\Auth\Response $response
     * @return type
     */

    /* Get General Details */

     public function get_district(Request $request){


      $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }

         $data = \DB::table('district_master')->where('StateId',$auth['StateId'])->orderBy('DistrictName', 'ASC')->lists('DistrictName', 'DistrictId');

            return response()->json($data, 200);
   
    }

    public function get_multiple_district(Request $request){


      $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }

        foreach ($auth['StateId'] as $state_key => $state_value) {

          $temp_state = \DB::table('state_masters')->where('StateId',$state_value)->pluck('StateName');

          $data[$temp_state] = \DB::table('district_master')->where('StateId',$state_value)->orderBy('DistrictName', 'ASC')->lists('DistrictName', 'DistrictId');


        }
        
        return response()->json($data, 200);
   
    }

    public function get_city(Request $request){


      $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }

         $data = \DB::table('city_masters')->where('DistrictId',$auth['DistrictId'])->orderBy('CityName', 'ASC')->lists('CityName', 'CityId');

            return response()->json($data, 200);
   
    }


    public function get_branch(Request $request){


      $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }

             foreach ($auth['degreeId'] as $key => $value) {
                
                $selected_degree[$key]['id'] = $value;

                $selected_degree[$key]['name'] = \DB::table('degree_subtype')->where('id','>=',1)->where('id', $value)->pluck('degree_subtype_name');
            }


         foreach ($selected_degree as $dkey => $dvalue) {

               $branch_of_degree = \DB::table('course_master')->where('id','>=',1)->where('degree_subtype_id', $dvalue['id'])->get(['id']);

                foreach ($branch_of_degree as $bdkey => $bdvalue) {
                   
                            $branch_tmp = \DB::table('course_master')->where('id','>=',1)->where('id', $bdvalue->id)->pluck('course_name');
                            $branch_by_degree[$dvalue['name']][$bdvalue->id] = $branch_tmp;
                    
                }

           }  

            return response()->json($branch_by_degree, 200);
   
    }

    public function get_ug_branch(Request $request){


      $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }

        

             
                $selected_degree['id'] = $auth['degreeId'];

                $selected_degree['name'] = \DB::table('degree_subtype')->where('id','>=',1)->where('id', $auth['degreeId'])->pluck('degree_subtype_name');
           
                $branch_of_degree = \DB::table('course_master')->where('id','>=',1)->where('degree_subtype_id',  $selected_degree['id'])->get(['id']);

                foreach ($branch_of_degree as $bdkey => $bdvalue) {
                   
                            $branch_tmp = \DB::table('course_master')->where('id','>=',1)->where('id', $bdvalue->id)->pluck('course_name');
                            $branch_by_degree[$selected_degree['name']][$bdvalue->id] = $branch_tmp;

                    
                }
 

            return response()->json($branch_by_degree, 200);
   
    }

    public function get_multiple_branch(Request $request){


     $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }

             foreach ($auth['degreeId'] as $key => $value) {
                
                $selected_degree[$key]['id'] = $value;

                $selected_degree[$key]['name'] = \DB::table('degree_subtype')->where('id', $value)->pluck('degree_subtype_name');
            }


         foreach ($selected_degree as $dkey => $dvalue) {

               $branch_of_degree = \DB::table('course_master')->where('degree_subtype_id', $dvalue['id'])->get(['id']);

                foreach ($branch_of_degree as $bdkey => $bdvalue) {
                   
                            $branch_tmp = \DB::table('course_master')->where('id', $bdvalue->id)->pluck('course_name');
                            $branch_by_degree[$dvalue['name']][$bdvalue->id] = $branch_tmp;
                    
                }

           }

            return response()->json($branch_by_degree, 200);
   
    }

    public function get_venue_college(Request $request){


      $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }
          
          $data = CollegeMaster::where('city',$auth['cityId'])->orderBy('college_name', 'ASC')->lists('college_name', 'college_id');

            return response()->json($data, 200);
   
    }

    public function get_invited_college(Request $request){


      $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }

        

        foreach ($auth['DistrictId'] as $key => $value) {
                
                $selected_district[$key]['id'] = $value;

                $selected_district[$key]['name'] = \DB::table('district_master')->where('DistrictId', $value)->pluck('DistrictName');
            }

            $branch_by_degree=null;

         foreach ($selected_district as $dkey => $dvalue) {

               $branch_of_degree = CollegeMaster::where('district', $dvalue['id'])->get(['college_id']);
                  
                  foreach ($branch_of_degree as $bdkey => $bdvalue) {
                   
                            $branch_tmp = CollegeMaster::where('college_id', $bdvalue->college_id)->pluck('college_name');
                            $branch_by_degree[$dvalue['name']][$bdvalue->college_id] = $branch_tmp;
                    
                }

           }

            return response()->json($branch_by_degree, 200);
   
    }

    /*  */
    
    public function postLogin(Request $request) {

        $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }


        if (isset($auth)) {
            $credentials = ['email' => $auth['email'], 'password' => $auth['password']];
            try {
                if ($token = JWTAuth::attempt($credentials)) {
                    
                    $user = JWTAuth::toUser($token);

                    $update = \DB::table('users')->where('id', '=', $user['id'])->update(array('remember_token' => $token));
          
                    if($user['user_type'] == 1){

                      $user['batch'] = \DB::table('candidate_education_details')->where('student_id',$user['reg_id'])
                                        ->join('degree_subtype', 'degree_subtype.id', '=', 'candidate_education_details.degree_subtype')
                                        ->join('course_master', 'course_master.id', '=', 'candidate_education_details.degree_course')
                                        ->select('degree_subtype.degree_subtype_name','course_master.course_name','degree_subtype','degree_course','degree_year_of_passing')
                                        ->get();


                      foreach ( $user['batch'] as $key => $value) {
                        $degree= $value->degree_subtype;
                        $degree_course = $value->degree_course;
                        $degree_year_of_passing = $value->degree_year_of_passing;

                        $test_details[] = \DB::table('test_masters')->where('batch_degree',$degree)->where('status',1)->where('batch_branch',$degree_course)->where('batch_year',$degree_year_of_passing)->orderBy('title', 'ASC')->get(['title','test_id']);
                      }

                     $user['test_details'] = $test_details;

                    }

                    return response()->json(['token' => $token, 'user' => $user], 200);

                } 
                else {
                    return response()->json(['Invalid Credentials'], 404);
                }
            }
            catch (Exception $Exception) {
                return response()->json(['Unexpected error'], 404);
            }
        }
    }

    public function student_get_signup_details(Request $request){

       $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }


      if(in_array(26, $auth['qualification']) == 1 ){
        $degree_records['diploma'] = \DB::table('course_master')->where('id','>=',1)->where('degree_subtype_id',30)->orderBy('course_name', 'ASC')->lists('course_name', 'id');  

        $college_records['diploma'] = \DB::select('SELECT DISTINCT(cm.college_id) AS id,cm.college_name AS name FROM `college_course_master` AS ccm INNER JOIN `college_master` AS cm ON ccm.college_id = cm.college_id WHERE degree_type_id = 26');
      }
      
       if(in_array(20, $auth['qualification']) == 1 ){
        $degree_records['ug'] = \DB::table('degree_subtype')->where('id','>=',1)->where('degree_type_id',20)->orderBy('degree_subtype_name', 'ASC')->lists('degree_subtype_name', 'id'); 


        $college_records['ug'] = \DB::select('SELECT DISTINCT(cm.college_id) AS id,cm.college_name AS name FROM `college_course_master` AS ccm INNER JOIN `college_master` AS cm ON ccm.college_id = cm.college_id WHERE degree_type_id = 20'); 
      }

      if(in_array(21, $auth['qualification']) == 1 ){
        $degree_records['pg'] = \DB::table('degree_subtype')->where('id','>=',1)->where('degree_type_id',21)->orderBy('degree_subtype_name', 'ASC')->lists('degree_subtype_name', 'id');  

        $college_records['pg'] = \DB::select('SELECT DISTINCT(cm.college_id) AS id,cm.college_name AS name FROM `college_course_master` AS ccm INNER JOIN `college_master` AS cm ON ccm.college_id = cm.college_id WHERE degree_type_id = 21'); 

      }

      $board_records = \DB::table('school_board_masters')->orderBy('id', 'ASC')->lists('name', 'id');

      $medium_records = \DB::table('medium_of_instructions_masters')->orderBy('name', 'ASC')->lists('name', 'id');

      $state_records = \DB::table('state_masters')->orderBy('StateName', 'ASC')->lists('StateName', 'StateId');

         return response()->json([ "board_records"=>$board_records,"medium_records"=>$medium_records,"degree_records"=>$degree_records,"college_records"=>$college_records,"state_records"=>$state_records], 200);


        
    }

       public function viewLogin(Request $request){
       
       
       $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		

        $data['test_degree_id'] = implode(",",$data['test_degree_id']);

        $data['test_branch_id'] = implode(",",$data['test_branch_id']);
		
		$data['test_year'] = implode(",",$data['test_year']);
		
		$data['test_user_id'] = implode(",",$data['test_user_id']);
		
		//return response()->json($data, 200);

            try{
                $a =   TestLoginMaster::create($data);

                return response()->json([
                    'url'=>$a->test_login_id,
                     "reponseMessage"    => "Test Instance " .$data['title']. " Created Successfully",
                     "responseType"      => "success"
                    ], 200); 
            }
            catch(\Exception $e) {
                return response()->json([
                     "reponseMessage"    => "Test Instance Not Created",
                     "responseType"      => "failure"
                    ], 200); 
            }
        
    }

    public function check_test_id(Request $request){
       $post = $request->json('post');
    
        if (is_string($post)) {
            $data = json_decode($post, true);
        }

         $status = BatchMaster::where('test_id',$data)->pluck('status');
     
     $qp_id = BatchMaster::where('test_id',$data)->pluck('qp_id');

         $college_list = \DB::table('institution_master')->where('status',1)->orderBy('name', 'ASC')->lists('name', 'id');

        return response()->json(['availability'=>$status,'college'=>$college_list,'qp_id'=>$qp_id], 200); 
    }

    public function get_batch_degree_details(Request $request){
       $post = $request->json('post');
    
        if (is_string($post)) {
            $data = json_decode($post, true);
        }

         $batch_details = BatchMaster::where('batch_id',$data)->get(['batch_id','batch_degree','batch_branch','batch_year']);
		 

        return response()->json(['batch_details'=>$batch_details[0]], 200); 
    }

    public function check_test_login_id(Request $request){
       $post = $request->json('post');
    
        if (is_string($post)) {
            $data = json_decode($post, true); 
        }

         $status = TestLoginMaster::where('test_id',$data)->pluck('status');

        return response()->json(['availability'=>$status], 200); 
    }

      public function test_logout(Request $request){
       $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

         
		

            $time = Carbon::now();

            $update = \DB::table('users')->where('id', $data['user_id'])->update(array('remember_token' => ''));



            $a = StudentTestLoginMaster::where('test_id', $data['test_id'])->where('user_id', $data['user_id'])->update(['logout_time'=>$time,'status'=>0]);

            $result =    TestResponseMaster::get_test_report_student($data['test_id'],$data['student_id']);
        
            return response()->json(['result'=>$result[0],'total'=>$result[1],'is_logout'=>$a,'test_id'=> $data['test_id']], 200); 
    }


  
}
