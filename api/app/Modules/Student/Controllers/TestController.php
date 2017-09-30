<?php namespace App\Modules\Student\Controllers;



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
    
public function create_test_login(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

       

        $is_login = 0;$reappear_id = 0; $login_detail =[];
    
        $login_detail = StudentTestLoginMaster::where('user_id',$data['user_id'])->where('test_id',$data['test_id'])->get(['student_test_login_id','can_reappear','is_login','remember_question']);
         
        $testdetails= TestMaster::where('test_id',$data['test_id'])->get(['is_negative','number_of_questions','duration']); 

        if(isset($login_detail[0])){ 
            
            if($login_detail[0]->can_reappear){

                $reappear_id = $login_detail[0]->student_test_login_id;

            }

            $testdetails[0]->remember_question = $login_detail[0]->remember_question;

            $is_login = $login_detail[0]->is_login;

        }
        else{

            try{

                $data['batch_id'] = TestMaster::where('test_id',$data['test_id'])->pluck('batch_id');

                 $test_id = $data['test_id'];

                 $test_details = TestMaster::where('test_id',$test_id)->get(['qp_id','duration']);

                 $qp_id = $test_details[0]->qp_id;

                 $duration = $test_details[0]->duration * 60;

                 $section_list = SectionMaster::where('qp_id',$qp_id)->lists('section_id');

                            foreach ($section_list as $key => $value) {
                              $question_list[$key+1] = QuestionPaperQuestionsMaster::where('section_id', $value)->lists('qpq_id');

                              shuffle($question_list[$key+1]);
                            }

                $data['remember_question'] = json_encode($question_list);
                $data['time_remaining'] = $duration;

                 $a = StudentTestLoginMaster::create($data);

                 $testdetails[0]->remember_question = $data['remember_question'];

            }
            catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Can't login to test try again later",
                "responseType"      => "failure"
            ], 200);
        }

        }

        

        return response()->json([
            "responseType"      => "success",
            'is_login'          =>$is_login,
            'reappear_id'       =>$reappear_id,
            'testdetails'       =>$testdetails
            ], 200);
    }


    public function get_question_paper(Request $request){
        
        
      $id = $request->json('post');
    
        if (is_string($id)) {
            $id = json_decode($id, true);
        }
    
    
         $test_id = $id['test_id'];

         $test_question_records = TestMaster::where('test_id',$test_id)->get(['test_id','batch_id','qp_id','number_of_questions','total_marks','duration']);

         $qp_id = $test_question_records[0]->qp_id;

         $test_subjects = \DB::select(sprintf("SELECT DISTINCT(section_subject) AS subject_id,sub.name AS section_subject FROM section_masters AS s INNER JOIN subject_masters AS sub ON s.section_subject = sub.subject_id WHERE qp_id = %d",$qp_id));

         $section_records =  SectionMaster::get_section_list($qp_id);
       
         $Question_records =  \DB::select(sprintf("SELECT qpq_id,qpq_order_id,qp_id,q.section_id,section_order_id,q.subject_id,sub.name AS section_subject,question_type,question_text,question_image,answer_type,answer_option_type,marks,terms_condtions,q.status FROM question_paper_questions_masters AS q INNER JOIN subject_masters AS sub ON q.subject_id = sub.subject_id WHERE qp_id = %d",$qp_id));

         $Option_records =  \DB::select(sprintf("SELECT qpq_id,qpqa_id,section_id,section_order_id,qpq_order_id,answer_image,answer_text,is_correct FROM question_paper_question_answers_masters WHERE qp_id = %d",$qp_id));

       return response()->json( ['test_subjects'=>$test_subjects,'test_question_records'=>$test_question_records,'section_records'=>$section_records,'Question_records'=>$Question_records,'Option_records'=>$Option_records] , 200);
        
    }

    public function check_login(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }


        $is_login = 0;$reappear_id = 0; $login_detail =[];
        
        $login_detail = StudentTestLoginMaster::where('user_id',$data['user_id'])->where('test_id',$data['test_id'])->get(['student_test_login_id','can_reappear','is_login']);
    
        
         if(isset($data['set_login'])){

            $update = StudentTestLoginMaster::where('user_id',$data['user_id'])->where('test_id',$data['test_id'])->update(array('can_reappear' => 0,'is_login' => 1));        
         }

        if(isset($login_detail[0])){ 
            
            if($login_detail[0]->can_reappear){

                $reappear_id = $login_detail[0]->student_test_login_id;

            }

            $is_login = $login_detail[0]->is_login;

        }
        
        
        
        $testdetails= TestMaster::where('test_id',$data['test_id'])->get(['is_negative','number_of_questions','duration']); 
        
        

        return response()->json(['is_login'=>$is_login,'reappear_id'=>$reappear_id,'testdetails'=>$testdetails], 200);
    }

    public function test_question_details(Request $request){
         
         
        
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $finished_records = TestResponseMaster::where('test_id',$data['test_id'])->where('user_id',$data['user_id'])->get(['section_id','section_order_id','qpq_order_id','qpq_id','status','response_qpqa_id']);
  

        $status = StudentTestLoginMaster::where('test_id', '=', $data['test_id'])->where('user_id', '=', $data['user_id'])->get(['status','time_remaining']);
    
         return response()->json([            
            'finished_records' => $finished_records,
            'timetaken'=>$status[0]->time_remaining,
            'status'=>$status[0]->status,
            ], 200); 
        
    }

    public function submit_question(Request $request){
        
        
        
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $action = $data['action'];

        $a = StudentTestLoginMaster::where('test_id', $data['test_id'])->where('user_id', $data['user_id'])->update(['time_remaining'=>$data['duration']]);

        unset($data['action'],$data['duration']);


        $Section_records =  SectionMaster::where('qp_id',$data['qp_id'])->get(['section_id','number_of_questions_section']);
            $maximum_section_id =  \DB::select(sprintf("SELECT MAX(section_id) as id FROM `section_masters` WHERE qp_id =%s",$data['qp_id']));

            $a = null;


       try{
        
        if($action == 'create' && isset($data['response_qpqa_id']))
        {
      $data['created_on'] = Carbon::now();
      
      $data['currect_qpqa_id'] = QuestionPaperQuestionAnswersMaster::where('qpq_id',$data['qpq_id'])->where('is_correct',1)->pluck('qpqa_id');
      
      if($data['currect_qpqa_id'] == $data['response_qpqa_id']){
        $data['is_correct'] = 1;
      }
      else{
        $data['is_correct'] = 0;
      }
      
      $a =   TestResponseMaster::create($data);
    }
        elseif($action == 'update' && isset($data['response_qpqa_id'])){
      
      $data['currect_qpqa_id'] = QuestionPaperQuestionAnswersMaster::where('qpq_id',$data['qpq_id'])->where('is_correct',1)->pluck('qpqa_id');
      
      if($data['currect_qpqa_id'] == $data['response_qpqa_id']){
        $data['is_correct'] = 1;
      }
      else{
        $data['is_correct'] = 0;
      }
      
            $a =   TestResponseMaster::where('test_id', $data['test_id'])->where('section_order_id', $data['section_order_id'])->where('qpq_order_id', $data['qpq_order_id'])->where('user_id', $data['user_id'])->update($data);
        }

            return response()->json([
                "Section_records"   => $Section_records,
                "maximum_section_id"=> $maximum_section_id,
                "responseId"        => $a,
                "reponseMessage"    => "Answered successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                 "Section_records"   => $Section_records,
                "maximum_section_id"=> $maximum_section_id,
                "responseId"        => $a,
                "reponseMessage"    => "Already answered",
                "responseType"      => "failure"
            ], 200);
        }
        
    }

    public function update_remaining_time(Request $request){

        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $a = StudentTestLoginMaster::where('user_id',$data['user_id'])->where('test_id',$data['test_id'])->update(["time_remaining"=>$data['time_remaining']]);

            return response()->json($a, 200);

    }

     public function test_logout(Request $request){
       $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

            $time = Carbon::now();

            $update = \DB::table('users')->where('id', $data['user_id'])->update(array('remember_token' => ''));



            $a = StudentTestLoginMaster::where('test_id', $data['test_id'])->where('user_id', $data['user_id'])->update(['logout_time'=>$time,'status'=>2]);

            
        
            return response()->json(['is_logout'=>$a,'data'=> $data], 200); 
    }

    public function student_feedback(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

            try{
                TestStudentFeedbackMaster::create($data);

             return response()->json([
                "reponseMessage"    => "Thank you ! Feedback sent Successfully",
                "responseType"      => "Success"
            ], 200);
         }
         catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Error ! ... Feedback not sent ",
                "responseType"      => "failure"
            ], 200);
        }
    }


}






