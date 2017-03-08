<?php namespace App\Modules\Student\Controllers;



use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CandidateEducationDetail;
use App\CollegeMaster;
use App\NewCollegeMaster;
use App\CandidateMaster;
use App\BatchMaster;
use App\Users;




class StudentController extends Controller {   

    public function __construct() {
         
    }
    
public function GetBatchById(Request $request)
{
    
    $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $batch_details = BatchMaster::where('batch_id',$data)
                         ->join('college_master','batch_masters.college_id','=','college_master.college_id')
                         ->join('degree_subtype','degree_subtype.id','=','batch_masters.batch_degree')
                         ->join('course_master','course_master.id','=','batch_masters.batch_branch')
                         ->select('batch_masters.*','college_master.college_name','degree_subtype.degree_subtype_name','course_master.course_name')
                         ->get();

    return response()->json([ "batch_details"=>$batch_details], 200);
}


public function student_get_signup_details(Request $request){

       $auth = $request->json('post');
       
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }


      if(in_array(26, $auth['qualification']) == 1 ){
        $degree_records['diploma'] = \DB::table('course_master')->where('id','>=',1)->where('degree_subtype_id',30)->orderBy('course_name', 'ASC')->lists('course_name', 'id');  

      }
      
       if(in_array(20, $auth['qualification']) == 1 ){
        $degree_records['ug'] = \DB::table('degree_subtype')->where('id','>=',1)->where('degree_type_id',20)->orderBy('degree_subtype_name', 'ASC')->lists('degree_subtype_name', 'id'); 
      }

      if(in_array(21, $auth['qualification']) == 1 ){
        $degree_records['pg'] = \DB::table('degree_subtype')->where('id','>=',1)->where('degree_type_id',21)->orderBy('degree_subtype_name', 'ASC')->lists('degree_subtype_name', 'id');  
      }

      $board_records = \DB::table('school_board_masters')->orderBy('id', 'ASC')->lists('name', 'id');

      $medium_records = \DB::table('medium_of_instructions_masters')->orderBy('name', 'ASC')->lists('name', 'id');

      $state_records = \DB::table('state_masters')->orderBy('StateName', 'ASC')->lists('StateName', 'StateId');

         return response()->json([ "board_records"=>$board_records,"medium_records"=>$medium_records,"degree_records"=>$degree_records,"state_records"=>$state_records], 200);


        
    }



     public function submit_signup(Request $request)

        {
            
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

         


        $is_member = Users::where('email',$data['email'])->pluck('id');

       if ($is_member) {
         return response()->json([

                "reponseMessage"    => "Sorry , Email id already exists",
                "responseType"      => "failure"
            
            ], 200);
       }

        $userdata['user_type'] = 1;
        $userdata['name'] = $data['first_name'];
        $userdata['email'] = $data['email'];
        $userdata['password'] = bcrypt( $data['date_of_birth']);

        $data['career_interest'] = implode(',', $data['career_interest']);

        if(isset($data['diploma_college'])){
        $diploma_details['degree_type'] = 26;
        $diploma_details['degree_institution'] = $data['diploma_college'];
        $diploma_details['degree_subtype'] = 30;
        $diploma_details['degree_course'] = $data['diploma_branch'];
        $diploma_details['degree_medium'] = $data['diploma_medium'];
        $diploma_details['degree_percentage'] = $data['diploma_marks'];
        $diploma_details['degree_year_of_passing'] = $data['diploma_year'];
        }

        if(isset($data['ug_college'])){
        $ug_details['degree_type'] = 20;
        $ug_details['degree_institution'] = $data['ug_college'];
        $ug_details['degree_subtype'] = $data['ug_degree'];
        $ug_details['degree_course'] = $data['ug_branch'];
        $ug_details['degree_medium'] = $data['ug_medium'];
        $ug_details['degree_percentage'] = $data['ug_marks'];
        $ug_details['degree_year_of_passing'] = $data['ug_year'];
        }

        if(isset($data['pg_college'])){
        $pg_details['degree_type'] = 21;
        $pg_details['degree_institution'] = $data['pg_college'];
        $pg_details['degree_subtype'] = $data['pg_degree'];
        $pg_details['degree_course'] = $data['pg_branch'];
        $pg_details['degree_medium'] = $data['pg_medium'];
        $pg_details['degree_percentage'] = $data['pg_marks'];
        $pg_details['degree_year_of_passing'] = $data['pg_year'];
        }

        if(isset($data['new_diploma_college_name'])){

            $new_diploma_details['new_institution_degree_type'] = 26;
            $new_diploma_details['new_institution_name'] = $data['new_diploma_college_name'];
            $new_diploma_details['new_institution_location'] = $data['new_diploma_college_location'];

            unset($data['new_diploma_college_name'],$data['new_diploma_college_location']);
        }

        if(isset($data['new_ug_college_name'])){

            $new_ug_details['new_institution_degree_type'] = 20;
            $new_ug_details['new_institution_name'] = $data['new_ug_college_name'];
            $new_ug_details['new_institution_location'] = $data['new_ug_college_location'];

            unset($data['new_ug_college_name'],$data['new_ug_college_location']);
        }
        if(isset($data['new_pg_college_name'])){

            $new_pg_details['new_institution_degree_type'] = 21;
            $new_pg_details['new_institution_name'] = $data['new_pg_college_name'];
            $new_pg_details['new_institution_location'] = $data['new_pg_college_location'];

            unset($data['new_pg_college_name'],$data['new_pg_college_location']);
        }

        unset( $data['diploma_college'],$data['diploma_branch'],$data['diploma_medium'],$data['diploma_marks'],$data['diploma_year'] );
        unset( $data['ug_college'],$data['ug_degree'],$data['ug_branch'],$data['ug_medium'],$data['ug_marks'],$data['ug_year'] );
        unset( $data['pg_college'],$data['pg_degree'],$data['pg_branch'],$data['pg_medium'],$data['pg_marks'],$data['pg_year'] );
          
        unset( $data['college_id'] );

          // return response()->json(['student_details'=>$data,'ug_details'=>$ug_details], 200);

        // return response()->json($data, 200);
        
        try{



          $a = CandidateMaster::create($data);

          $student_id = $a->student_id;

          $userdata['reg_id'] = $student_id;
        
        }

         catch(\Exception $exception) {

          return response()->json([

                "reponseMessage"    => "Student not registered , Invalid data provided",
                "responseType"      => "failure"
            
            ], 200);

        }

        

        try{


          $a = Users::create($userdata);

          $user_id = $a->id;
        
        }
        catch(\Exception $exception) {

          return response()->json([

                "reponseMessage"    => "Registered partially, Please contact first.jobs support team ",
                "responseType"      => "failure"
            
            ], 200);

        }

        if(isset($new_diploma_details)){

            $new_diploma_details['created_by'] = $student_id;

            try{
                $new_diploma = NewCollegeMaster::create($new_diploma_details);

                $new_diploma_id = $new_diploma->new_institution_id;
            }
            catch(\Exception $exception) {
                return response()->json(["reponseMessage"    => "Diploma new college not added , Invalid data provided","responseType"      => "failure"], 200);
            }

         }

         if(isset($new_ug_details)){

            $new_ug_details['created_by'] = $student_id;

            try{
                $new_ug = NewCollegeMaster::create($new_ug_details);

                $new_ug_id = $new_ug->new_institution_id;
            }
            catch(\Exception $exception) {
                return response()->json(["reponseMessage"    => "UG new college not added , Invalid data provided","responseType"      => "failure"], 200);
            }

         }

         if(isset($new_pg_details)){

            $new_pg_details['created_by'] = $student_id;

            try{
                $new_pg = NewCollegeMaster::create($new_pg_details);

                $new_pg_id = $new_pg->new_institution_id;
            }
            catch(\Exception $exception) {
                return response()->json(["reponseMessage"    => "PG new college not added , Invalid data provided","responseType"      => "failure"], 200);
            }

         }

         if(isset($diploma_details)){

            $diploma_details['student_id'] = $student_id;

            if(isset($new_diploma_id)){
                $diploma_details['new_institution_id'] = $new_diploma_id;
            }

            try{
                $diploma = CandidateEducationDetail::create($diploma_details);
            }
            catch(\Exception $exception) {
                return response()->json(["reponseMessage"    => "Diploma degree not added , Invalid data provided","responseType"      => "failure"], 200);
            }

         }

         if(isset($ug_details)){

            $ug_details['student_id'] = $student_id;

            if(isset($new_ug_id)){
                $ug_details['new_institution_id'] = $new_ug_id;
            }

            try{
                $ug = CandidateEducationDetail::create($ug_details);
            }
            catch(\Exception $exception) {
                return response()->json(["reponseMessage"    => "UG degree not added , Invalid data provided","responseType"      => "failure"], 200);
            }

         }

         if(isset($pg_details)){

            $pg_details['student_id'] = $student_id;

            if(isset($new_pg_id)){
                $pg_details['new_institution_id'] = $new_pg_id;
            }

            try{
                $pg = CandidateEducationDetail::create($pg_details);
            }
            catch(\Exception $exception) {
                return response()->json(["reponseMessage"    => "PG degree not added , Invalid data provided","responseType"      => "failure"], 200);
            }

         }




          return response()->json([
                "student_id"        =>  $student_id,
                "user_id"           =>  $user_id,
                "reponseMessage"    => "Thank you ! <br><br> Student profile registered successfully.<br><br> Login now with your password : YYYY-MM-DD  ",
                "responseType"      => "success"
            ], 200);

      }



public function dashboard_details(Request $request)
{
    
    $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        // $college_id = CandidateMaster::where('student_id',$data)->pluck("college_id");

        $user['batch'] = \DB::table('candidate_education_details')->where('student_id',$data)
                                        ->join('degree_subtype', 'degree_subtype.id', '=', 'candidate_education_details.degree_subtype')
                                        ->join('course_master', 'course_master.id', '=', 'candidate_education_details.degree_course')
                                        ->select('candidate_education_details.degree_institution as college_id','degree_subtype.degree_subtype_name','course_master.course_name','degree_subtype','degree_course','degree_year_of_passing')
                                        ->get();

                                        

                                        $test_details = null;

                      foreach ( $user['batch'] as $key => $value) {

                        $degree= $value->degree_subtype;
                        $college_id= $value->college_id; 
                        $degree_course = $value->degree_course;
                        $degree_year_of_passing = $value->degree_year_of_passing;

                           $tmp = \DB::select(sprintf('SELECT t.title,t.test_id,sl.is_login,sl.can_reappear,sl.score,sl.status,t.status as test_status FROM `test_masters` AS t LEFT JOIN `student_test_login_masters` AS sl ON t.test_id = sl.test_id AND sl.student_id = "%d" WHERE  t.college_id = "%d" AND t.batch_degree = "%d" AND t.batch_branch = "%d" AND t.batch_year_to = "%d"',$data,$college_id,$degree,$degree_course,$degree_year_of_passing));

                        if($tmp != null){
                          $test_details[] = $tmp;
                        }
                        
                      }

                     $user['test_details'] = $test_details;

                     return response()->json(["user" =>  $user], 200);
}


}






