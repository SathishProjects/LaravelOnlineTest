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
use App\SubjectMaster;
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

    public function get_degree(Request $request){ 

        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
    
         $branch = \DB::table('degree_subtype')->orderBy('degree_subtype_name', 'ASC')->select('id','degree_type_id','degree_subtype_name')->get();

            $degree_list['ug'] = []; $ug = 0;
            $degree_list['pg'] = []; $pg = 0;
            $degree_list['diploma'] = []; $diploma = 0;

           foreach ($branch as $dkey => $dvalue) {
               
               if($dvalue->degree_type_id == 26){
            
                $degree_list['diploma'][$diploma]['id'] = $dvalue->id;

               $degree_list['diploma'][$diploma]['name'] = $dvalue->degree_subtype_name;

               $diploma++;
               
               }

               if($dvalue->degree_type_id == 20){

               $degree_list['ug'][$ug]['id'] = $dvalue->id;

               $degree_list['ug'][$ug]['name'] = $dvalue->degree_subtype_name;

               $ug++;

                }

               if($dvalue->degree_type_id == 21){

                $degree_list['pg'][$pg]['id'] = $dvalue->id;

               $degree_list['pg'][$pg]['name'] = $dvalue->degree_subtype_name;

               $pg++;
               
               }
           
       }  

           return response()->json(['degree_list'=>$degree_list], 200);


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

    public function get_chapter(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $Chapter_Records = SubjectMaster::where('reference_id', '=',$data['subject_id'])->orderBy('subject_id', 'ASC')->lists('name', 'subject_id');
        return response()->json($Chapter_Records, 200); 
        
        
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



  
}
