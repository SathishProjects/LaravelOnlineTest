<?php namespace App\Modules\College\Controllers;



use JWTAuth;
use Redirect;
use Carbon;
use App\DegreeType;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuestionPaperMaster;
use App\QuestionPaperSubjectMaster;
use App\SectionMaster;
use App\SubjectMaster;
use App\QuestionPaperQuestionsMaster;
use App\QuestionPaperQuestionAnswersMaster;
use App\BatchMaster;
use App\TestLoginMaster;
use App\TestMaster;
use App\Users;
use App\CandidateEducationDetail;
use App\TestResponseMaster;
use App\TestReportMaster;
use App\StudentTestLoginMaster;
use App\TestAdminFeedbackMaster;
use App\TestStudentFeedbackMaster;
use App\CandidateMaster;
use Illuminate\Support\Facades\Input;

use Cache;



class TestController extends Controller {   

    public function __construct() {
       
    }
  


public function get_batch_degree_details(Request $request){
       $post = $request->json('post');
    
        if (is_string($post)) {
            $data = json_decode($post, true);
        }

         $batch_details = BatchMaster::where('batch_id',$data)->get(['batch_id','batch_degree','batch_branch','batch_year','batch_year_to']);
         

        return response()->json(['batch_details'=>$batch_details[0]], 200); 
    }

    public function check_questionpaper(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        

        try{
           $record = QuestionPaperMaster::where('qp_id', $data['qp_id'])->where('college_id', $data['college_id'])->where('status', '=' , '1')->get();
            
             return response()->json([
                "record"                => $record,
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "responseType"      => "failure"
            ], 200);
        }

    }

    public function assign_starttest(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }


        try{

            $a = TestMaster::create($data);

            return response()->json([
                "id"                => $a->test_id,
                "reponseMessage"    => "Test assigned successfully",
                "responseType"      => "success"
            ], 200);


        } 
        catch(\Exception $e) {

            return response()->json([
                "reponseMessage"    => "Error in assigning the test",
                "responseType"      => "failure"
            ], 200);

        }


    }

    public function admin_viewstudents(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

            $test_details = TestMaster::where('test_id',$data['test_id'])
                            ->join('course_master', 'course_master.id', '=', 'test_masters.batch_branch')
                            ->join('degree_subtype', 'degree_subtype.id', '=', 'test_masters.batch_degree')
                            ->select('test_masters.*','course_master.course_name as branch','degree_subtype.degree_subtype_name as degree')
                            ->get();
            
            $questionpaper_subject_list =  SectionMaster::get_questionpaper_subject_list($test_details[0]->qp_id);

            $student_details = StudentTestLoginMaster::where('test_id',$data['test_id'])->get(['user_id','student_id','login_attempt','login_time','logout_time','status']);

            foreach ($student_details as $key => $value) {
                
                $tmp =  \DB::table('users')->where('reg_id',$value->student_id)->where('user_type',1)->get(['name','email']);
                
                if($tmp){
                $value->name = $tmp[0]->name;
                $value->email =$tmp[0]->email;
                }
                else{
                    $value->name = '-';
                    $value->email = '-' ;
                }
                
                $mark_detail = \DB::select(sprintf("SELECT COUNT(test_response_id) AS attended,SUM(is_correct) AS correct FROM `test_response_masters` WHERE student_id = %d AND test_id = %d",$value->student_id,$test_details[0]->test_id));
                
                if($mark_detail[0]->correct == null){ $mark_detail[0]->correct = 0; }
                    
                $value->correct = $mark_detail[0]->correct;
                $value->attended = $mark_detail[0]->attended;
                    
            }

            return response()->json([
                "test_details"   => $test_details,
                "student_details"   => $student_details,
                "questionpaper_subject_list"   => $questionpaper_subject_list,
                "reponseMessage"    => "Success",
                "responseType"      => "success"
            ], 200);

        
    }

    public function reappear_student(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        // return response()->json($data, 200); 

        $student_id = \DB::table('users')->where('email', '=', $data['email'])->pluck('id');  

        $now = Carbon::now();

        $login_attempt = StudentTestLoginMaster::where('user_id', $student_id)->pluck('login_attempt'); 
            
        $update_data = ['status'=>1,'can_reappear'=>1,'is_login'=>0,'login_attempt'=>$login_attempt+1];
            
        $tmp_reappear_reason = StudentTestLoginMaster::where('user_id', $student_id)->where('test_id', $data['test_id'])->pluck('reappear_reason');

            if($tmp_reappear_reason){
                
                 $update_data['reappear_reason'] = $data['reason'].','.$tmp_reappear_reason;
            }
            else{
                $update_data['reappear_reason'] = $data['reason'];
            }
            
            // return response()->json($update_data, 200); 


        try{
          
            if($login_attempt < 4){

                $b = StudentTestLoginMaster::where('user_id', $student_id)->where('test_id', $data['test_id'])->pluck('can_reappear');

                if($b === 0){
                    
                $a = StudentTestLoginMaster::where('user_id', $student_id)->where('test_id', $data['test_id'])->update($update_data);
                    
                return response()->json([
                    "reponseMessage"    => "Student can now login once again and proceed the test",
                    "responseType"      => "success"
                ], 200);
                }
                elseif($b == null){
                    return response()->json([
                    "reponseMessage"    => "Sorry ! Student not yet logged in for the test",
                    "responseType"      => "failure"
                ], 200);
                }
                elseif($b == 1){
                    return response()->json([
                    "reponseMessage"    => "Request already processed ! Student can login and attend the test",
                    "responseType"      => "failure"
                ], 200);    

                }

            }
          else{

            return response()->json([
                "reponseMessage"    => "Sorry ! Student crossed maximum limit for re-appearing",
                "responseType"      => "failure"
            ], 200);


          }

        } 
        catch(\Exception $e) {

            return response()->json([
                "reponseMessage"    => "Error in re-appearing for the test , Try Again!",
                "responseType"      => "failure"
            ], 200);

        } 
        


    }

    public function delete_test(Request $request){
        
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        // return response()->json($data, 200);
        
        try{ 

            $a = TestMaster::where('test_id', $data['test_id'])->delete();  
          
            return response()->json([
                "reponseMessage"    => " Test deleted successfully ",
                "responseType"      => "success"
            ], 200);


        } 
        catch(\Exception $e) {

            return response()->json([
                "reponseMessage"    => "Error in deleting the test",
                "responseType"      => "failure"
            ], 200);

        }


    }

     public function starttest(Request $request){
        
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $now = Carbon::now();
        
        try{ 

            $a = TestMaster::where('test_id', $data['test_id'])->update(['status'=>1,'started_on'=>$now]);  
          
            return response()->json([
                "reponseMessage"    => " Test started successfully ",
                "responseType"      => "success"
            ], 200);


        } 
        catch(\Exception $e) {

            return response()->json([
                "reponseMessage"    => "Error while starting the test",
                "responseType"      => "failure"
            ], 200);

        }


    }

    public function download_batch_students(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

            $batch = BatchMaster::where('batch_id',$data)->get(['batch_id','college_id','batch_type','batch_degree','batch_branch','batch_year','batch_year_to']);

            
            $temp1 =  sprintf("  SELECT cm.student_id,cm.first_name,cm.last_name,cm.gender,cm.date_of_birth,cm.email,cm.mobile,cm.address1,cm.address2,cm.pincode,cm.core_skill,cm.other_skills,cm.work_mode,cm.availability,
cm.sslc_school,cm.sslc_marks,cm.sslc_year,sbm1.name AS sslc_board,lg1.name AS sslc_medium,
cm.hsc_school,cm.hsc_marks,cm.hsc_year,sbm2.name AS hsc_board,lg2.name AS hsc_medium,lg.name AS mother_tongue,pl.name AS preferred_location,
cm.status,st.StateName AS state,dist.districtName AS district,cty.CityName AS city,

( SELECT GROUP_CONCAT( lgm.name ) FROM `language_master` AS lgm WHERE FIND_IN_SET(lgm.id, cm.language_known ) ) AS language_known,
( SELECT GROUP_CONCAT( ci.name ) FROM `career_interest_masters` AS ci WHERE FIND_IN_SET(ci.id, cm.career_interest ) ) AS career_interest,
( SELECT GROUP_CONCAT( tsm.name ) FROM `technical_skills_master` AS tsm WHERE FIND_IN_SET(tsm.id, cm.technical_skills ) ) AS technical_skills,

ce_u.degree_institution AS ug_institution,ce_u.new_institution_id AS ug_new_institution,ds2.degree_subtype_name AS ug_subtype,cs2.course_name AS ug_course,lg4.name AS  ug_medium,ce_u.degree_percentage AS ug_percentage,ce_u.degree_year_of_passing AS ug_year_of_passing,cm_u1.college_name AS ug_institution_name1,cm_u2.college_name AS ug_institution_name2,

ce_p.degree_institution AS pg_institution,ce_p.new_institution_id AS pg_new_institution,ds3.degree_subtype_name AS pg_subtype,cs3.course_name AS pg_course,lg5.name AS  pg_medium,ce_p.degree_percentage AS pg_percentage,ce_p.degree_year_of_passing AS pg_year_of_passing,cm_p1.college_name AS pg_institution_name1,cm_p2.college_name AS pg_institution_name2,

ce_d.degree_institution AS diploma_institution,ce_d.new_institution_id AS diploma_new_institution,ds1.degree_subtype_name AS diploma_subtype,cs1.course_name AS diploma_course,lg3.name AS diploma_medium,ce_d.degree_percentage AS diploma_percentage,ce_d.degree_year_of_passing AS diploma_year_of_passing,cm_d1.college_name AS diploma_institution_name1,cm_d2.college_name AS diploma_institution_name2


FROM `candidate_master` AS cm 

LEFT JOIN `candidate_education_details` AS ce_u ON ce_u.student_id = cm.student_id AND ce_u.degree_type = 20
LEFT JOIN `candidate_education_details` AS ce_p ON ce_p.student_id = cm.student_id AND ce_p.degree_type = 21
LEFT JOIN `candidate_education_details` AS ce_d ON ce_d.student_id = cm.student_id AND ce_d.degree_type = 26 

LEFT JOIN `medium_of_instructions_masters` AS lg4 ON lg4.id = ce_u.degree_medium
LEFT JOIN `medium_of_instructions_masters` AS lg5 ON lg5.id = ce_p.degree_medium
LEFT JOIN `medium_of_instructions_masters` AS lg3 ON lg3.id = ce_d.degree_medium

LEFT JOIN `degree_subtype` AS ds2 ON ds2.id = ce_u.degree_subtype
LEFT JOIN `degree_subtype` AS ds3 ON ds3.id = ce_p.degree_subtype
LEFT JOIN `degree_subtype` AS ds1 ON ds1.id = ce_d.degree_subtype

LEFT JOIN `course_master` AS cs2 ON cs2.id = ce_u.degree_course
LEFT JOIN `course_master` AS cs3 ON cs3.id = ce_p.degree_course 
LEFT JOIN `course_master` AS cs1 ON cs1.id = ce_d.degree_course

LEFT JOIN `college_master` AS cm_u1 ON cm_u1.college_id = ce_u.degree_institution
LEFT JOIN `college_master` AS cm_p1 ON cm_p1.college_id = ce_p.degree_institution
LEFT JOIN `college_master` AS cm_d1 ON cm_d1.college_id = ce_d.degree_institution

LEFT JOIN `college_master` AS cm_u2 ON cm_u2.college_id = ce_u.new_institution_id
LEFT JOIN `college_master` AS cm_p2 ON cm_p2.college_id = ce_p.new_institution_id
LEFT JOIN `college_master` AS cm_d2 ON cm_d2.college_id = ce_d.new_institution_id

LEFT JOIN `school_board_masters` AS sbm1 ON sbm1.id = cm.sslc_board
LEFT JOIN `school_board_masters` AS sbm2 ON sbm2.id = cm.hsc_board
LEFT JOIN `medium_of_instructions_masters` AS lg1 ON lg1.id = cm.sslc_medium
LEFT JOIN `medium_of_instructions_masters` AS lg2 ON lg2.id = cm.hsc_medium
LEFT JOIN `preferred_location` AS pl ON pl.id = cm.preferred_location
LEFT JOIN `language_master` AS lg ON lg.id = cm.mother_tongue
LEFT JOIN `state_masters` AS st ON st.StateId = cm.state
LEFT JOIN `district_master` AS dist ON dist.DistrictId = cm.district
LEFT JOIN `city_masters` AS cty ON cty.CityId = cm.city   ");

                            if($batch[0]->batch_type == 20){
                                    $temp2 = sprintf(" WHERE ce_u.degree_institution = (%d) AND ce_u.degree_subtype = (%d)  AND ce_u.degree_course = (%d) AND ce_u.degree_year_of_passing = (%d)",$batch[0]->college_id,$batch[0]->batch_degree,$batch[0]->batch_branch,$batch[0]->batch_year_to);
                            }

                            $tmp_detail = $temp1.$temp2;

                            $data = \DB::select($tmp_detail);
                                        

    return response()->json(['data'=>$data], 200); 

        
    }

    public function download_batch_report(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

            $batch = BatchMaster::where('batch_id',$data)->get(['batch_id','college_id','batch_type','batch_degree','batch_branch','batch_year','batch_year_to']);

            $test_record = TestMaster::where('batch_id',$data)->get(['test_id','title']);

            
            $temp1 =  sprintf("  SELECT cm.student_id,cm.first_name,cm.last_name,cm.gender,cm.date_of_birth,cm.email,cm.mobile,cm.address1,cm.address2,cm.pincode,cm.core_skill,cm.other_skills,cm.work_mode,cm.availability,
cm.sslc_school,cm.sslc_marks,cm.sslc_year,sbm1.name AS sslc_board,lg1.name AS sslc_medium,
cm.hsc_school,cm.hsc_marks,cm.hsc_year,sbm2.name AS hsc_board,lg2.name AS hsc_medium,lg.name AS mother_tongue,pl.name AS preferred_location,
cm.status,st.StateName AS state,dist.districtName AS district,cty.CityName AS city,

( SELECT GROUP_CONCAT( lgm.name ) FROM `language_master` AS lgm WHERE FIND_IN_SET(lgm.id, cm.language_known ) ) AS language_known,
( SELECT GROUP_CONCAT( ci.name ) FROM `career_interest_masters` AS ci WHERE FIND_IN_SET(ci.id, cm.career_interest ) ) AS career_interest,
( SELECT GROUP_CONCAT( tsm.name ) FROM `technical_skills_master` AS tsm WHERE FIND_IN_SET(tsm.id, cm.technical_skills ) ) AS technical_skills,

ce_u.degree_institution AS ug_institution,ce_u.new_institution_id AS ug_new_institution,ds2.degree_subtype_name AS ug_subtype,cs2.course_name AS ug_course,lg4.name AS  ug_medium,ce_u.degree_percentage AS ug_percentage,ce_u.degree_year_of_passing AS ug_year_of_passing,cm_u1.college_name AS ug_institution_name1,cm_u2.college_name AS ug_institution_name2,

ce_p.degree_institution AS pg_institution,ce_p.new_institution_id AS pg_new_institution,ds3.degree_subtype_name AS pg_subtype,cs3.course_name AS pg_course,lg5.name AS  pg_medium,ce_p.degree_percentage AS pg_percentage,ce_p.degree_year_of_passing AS pg_year_of_passing,cm_p1.college_name AS pg_institution_name1,cm_p2.college_name AS pg_institution_name2,

ce_d.degree_institution AS diploma_institution,ce_d.new_institution_id AS diploma_new_institution,ds1.degree_subtype_name AS diploma_subtype,cs1.course_name AS diploma_course,lg3.name AS diploma_medium,ce_d.degree_percentage AS diploma_percentage,ce_d.degree_year_of_passing AS diploma_year_of_passing,cm_d1.college_name AS diploma_institution_name1,cm_d2.college_name AS diploma_institution_name2


FROM `candidate_master` AS cm 

LEFT JOIN `candidate_education_details` AS ce_u ON ce_u.student_id = cm.student_id AND ce_u.degree_type = 20
LEFT JOIN `candidate_education_details` AS ce_p ON ce_p.student_id = cm.student_id AND ce_p.degree_type = 21
LEFT JOIN `candidate_education_details` AS ce_d ON ce_d.student_id = cm.student_id AND ce_d.degree_type = 26 

LEFT JOIN `medium_of_instructions_masters` AS lg4 ON lg4.id = ce_u.degree_medium
LEFT JOIN `medium_of_instructions_masters` AS lg5 ON lg5.id = ce_p.degree_medium
LEFT JOIN `medium_of_instructions_masters` AS lg3 ON lg3.id = ce_d.degree_medium

LEFT JOIN `degree_subtype` AS ds2 ON ds2.id = ce_u.degree_subtype
LEFT JOIN `degree_subtype` AS ds3 ON ds3.id = ce_p.degree_subtype
LEFT JOIN `degree_subtype` AS ds1 ON ds1.id = ce_d.degree_subtype

LEFT JOIN `course_master` AS cs2 ON cs2.id = ce_u.degree_course
LEFT JOIN `course_master` AS cs3 ON cs3.id = ce_p.degree_course 
LEFT JOIN `course_master` AS cs1 ON cs1.id = ce_d.degree_course

LEFT JOIN `college_master` AS cm_u1 ON cm_u1.college_id = ce_u.degree_institution
LEFT JOIN `college_master` AS cm_p1 ON cm_p1.college_id = ce_p.degree_institution
LEFT JOIN `college_master` AS cm_d1 ON cm_d1.college_id = ce_d.degree_institution

LEFT JOIN `college_master` AS cm_u2 ON cm_u2.college_id = ce_u.new_institution_id
LEFT JOIN `college_master` AS cm_p2 ON cm_p2.college_id = ce_p.new_institution_id
LEFT JOIN `college_master` AS cm_d2 ON cm_d2.college_id = ce_d.new_institution_id

LEFT JOIN `school_board_masters` AS sbm1 ON sbm1.id = cm.sslc_board
LEFT JOIN `school_board_masters` AS sbm2 ON sbm2.id = cm.hsc_board
LEFT JOIN `medium_of_instructions_masters` AS lg1 ON lg1.id = cm.sslc_medium
LEFT JOIN `medium_of_instructions_masters` AS lg2 ON lg2.id = cm.hsc_medium
LEFT JOIN `preferred_location` AS pl ON pl.id = cm.preferred_location
LEFT JOIN `language_master` AS lg ON lg.id = cm.mother_tongue
LEFT JOIN `state_masters` AS st ON st.StateId = cm.state
LEFT JOIN `district_master` AS dist ON dist.DistrictId = cm.district
LEFT JOIN `city_masters` AS cty ON cty.CityId = cm.city   ");

                            if($batch[0]->batch_type == 20){
                                    $temp2 = sprintf(" WHERE ce_u.degree_institution = (%d) AND ce_u.degree_subtype = (%d)  AND ce_u.degree_course = (%d) AND ce_u.degree_year_of_passing = (%d)",$batch[0]->college_id,$batch[0]->batch_degree,$batch[0]->batch_branch,$batch[0]->batch_year_to);
                            }

                            $tmp_detail = $temp1.$temp2;

                            $data = \DB::select($tmp_detail);

                            foreach ($data as $dtkey => $dtvalue) {
                                foreach ($test_record as $trkey => $trvalue) {

                                    $title = $trvalue->title;

                                    $dtvalue->$title = StudentTestLoginMaster::where('student_id',$dtvalue->student_id)->where('test_id',$trvalue->test_id)->pluck('score');
                                }
                            }
                                        

    return response()->json(['data'=>$data,'test_record'=>$test_record], 200); 

        
    }

    public function endtest(Request $request){
      
        $data = $request->json('post'); 
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
              
              $data['ended_on'] = Carbon::now();

              $data['status'] = 2;

                
            $test_id = $data['test_id'];
            $qp_id = TestMaster::where('test_id',$data['test_id'])->pluck('qp_id');
            
            $students_list =   StudentTestLoginMaster::get_attended_students_list($test_id);

            $subject_list =  SectionMaster::get_questionpaper_subject_list($qp_id);

            
            $report_status = TestReportMaster::generate_report($test_id,$students_list,$subject_list);

            
            try{
                TestMaster::where('test_id',$data['test_id'])->update($data);

             return response()->json([
                "test_id"           => $test_id,
                "success_count"     => $report_status,
                "reponseMessage"    => "Test ended Successfully",
                "responseType"      => "Success"
            ], 200);
         }
         catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Failed to end test Try again !",
                "responseType"      => "failure"
            ], 200);
        }
    }




}






