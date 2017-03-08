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
use App\CollegeMaster;
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



class CollegeController extends Controller {   

    public function __construct() {
       
    }
  


public function get_collegesignup_details()
{
    $university_records = \DB::table('university_master')->orderBy('name', 'ASC')->lists('name', 'id');

    $state_records = \DB::table('state_masters')->orderBy('StateName', 'ASC')->lists('StateName', 'StateId');


    return response()->json([ "state_records"=>$state_records,"university_records"=>$university_records], 200);
}

public function submit_signup(Request $request){

       $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $userdata['user_type'] = 2 ;
        $userdata['email'] = $data['email'];
        $userdata['name'] = $data['college_name'] ;
        $userdata['password'] = bcrypt($data['pincode']) ;

        $is_registered = CollegeMaster::where('email',$data['email'])->pluck('college_id');

        if($is_registered){
            return response()->json([
                     "reponseMessage"    => "<center>Sorry ! College already registered</center>",
                     "responseType"      => "failure"
                    ], 200); 
        }

        try{
                $a =   CollegeMaster::create($data);
            }
            catch(\Exception $e) {
                return response()->json([
                     "reponseMessage"    => "<center>College registered partially ! Try Again Later</center>",
                     "responseType"      => "failure"
                    ], 200); 
            }

        try{
                    
                    $userdata['reg_id'] = $a->college_id;

                    $b =   Users::create($userdata);

                return response()->json([
                     "reponseMessage"    => "<center>College registered successfully ! <br> Check your E-mail and set password !!</center>",
                     "responseType"      => "success"
                    ], 200); 
                }
                catch(\Exception $e) {
                return response()->json([
                     "reponseMessage"    => "<center>College Not registered ! Try Again Later</center>",
                     "responseType"      => "failure"
                    ], 200); 
                }    

    }

     public function dashboard_batch_details(Request $request){

     

     $data = $request->json('post');

       if (is_string($data)) {
            $data = json_decode($data, true);
      }
      
        $batch= BatchMaster::getBatch($data['college_id'],$data['status']);

       $count2 = \DB:: select (sprintf("(SELECT (SELECT COUNT(qp_id) AS inactive FROM `question_paper_masters` WHERE STATUS = 0) AS qp_inactive,(SELECT COUNT(qp_id) AS active FROM `question_paper_masters` WHERE STATUS = 1) AS qp_active)"));

       return response()->json(["data"=>$data,"batch"=>$batch,"count2"=>$count2], 200);
   
    }

    public function dashboard_questionpaper_details(Request $request){

       $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }


       $first_last =  \DB :: select(sprintf("CALL select_questionpaper_first_last ('%s','%s','%s')",$data['search_key'],$data['status'],$data['college_id']));

       $a= \DB :: select(sprintf("CALL select_questions ('%s','%s','%s','%s','%s')",$data['action'],$data['action_value'],$data['search_key'],$data['status'],$data['college_id']));

       $count2 = \DB:: select (sprintf("(SELECT (SELECT COUNT(qp_id) AS inactive FROM `question_paper_masters` WHERE STATUS = 0 and college_id = '%d') AS qp_inactive,(SELECT COUNT(qp_id) AS active FROM `question_paper_masters` WHERE STATUS = 1 and college_id = '%d') AS qp_active)",$data['college_id'],$data['college_id']));

       return response()->json(["count2"=>$count2,"first_last"=>$first_last,'qp_details'=>$a], 200);
   
    }

    public function set_questionpaper(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        try{
            $a=QuestionPaperMaster::saveall($data);
            
             return response()->json([
                "id"                => $a,
                "reponseMessage"    => "Question Paper Created successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Question Paper Not created",
                "responseType"      => "failure"
            ], 200);
        }

    }

    public function get_questionpaper_detail(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

            $return_data =    QuestionPaperMaster::save_return_data($data);
            $Subject_Records = SubjectMaster::where('reference_id', '=',null)->orderBy('subject_id', 'ASC')->lists('name', 'subject_id');
            $Section_records =  SectionMaster::get_section_data($data);

            return response()->json(["qp_details"=>$return_data,"subject"=>$Subject_Records,"section"=>$Section_records], 200);
        
        
    }

    public function get_questionpaper_detail2(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
// $data = Input::all();
            $return_data =    QuestionPaperMaster::save_return_data($data[0]);
            
            $Section_records =  SectionMaster::get_section_data($data[0]);

            $finished_questions = QuestionPaperQuestionsMaster::get_section_finished_questions($data[0]);

            $current_question = QuestionPaperQuestionsMaster::get_current_question_details($data[0],$data[1],$data[2]);

            return response()->json(["qp_details"=>json_encode($return_data),"section"=>json_encode($Section_records),"finished_questions"=>json_encode($finished_questions),'current_question'=>json_encode($current_question)], 200);
        
            // return response()->json(['current_question'=>$current_question], 200);
        
        
    }

    public function get_section_chapter(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $Section_chapter_records =  SectionMaster::get_section_chapter_data($data);
        return response()->json($Section_chapter_records, 200);  
        
        
    }

    public function add_section(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

       unset($data['question_image']);
        try{
            $a=SectionMaster::saveall($data);
            
             return response()->json([
                "id"                => $a,
                "reponseMessage"    => "Section Added successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Section not added successfully",
                "responseType"      => "failure"
            ], 200);
        }
        
        
    }

    public function update_section(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }



        $section_id = $data['section_id'];

        unset($data['section_id'],$data['question_image'],$data['_token']);

       
        try{
            SectionMaster::where('section_id', $section_id)->update($data);
            
             return response()->json([
                "reponseMessage"    => "Section updated successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Section not updated successfully",
                "responseType"      => "failure"
            ], 200);
        }
        
        
    }

    public function edit_questionpaper(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $return_data =    QuestionPaperMaster::save_return_data($data);

        return response()->json(["details"=>$return_data], 200); 
        
        
    }

    public function update_questionpaper(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $qp_id = $data['qp_id'];

        unset($data['qp_id']);

        try{
        QuestionPaperMaster::where('qp_id', $qp_id)->update($data);

            return response()->json([
                "reponseMessage"    => "Question paper updated successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Question paper not updated ",
                "responseType"      => "failure"
            ], 200);
        }
        
    }

    public function add_question(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $answer_data = $data;



        $answer_data['answer_text'] = $answer_data['option_text'] ;

        $correct_answer_key = $answer_data['option_is_correct'];

        $answer_temp_text = $answer_data['answer_text'];

        unset($answer_data['option_image'],$answer_data['marks'],$answer_data['answer_text'],$answer_data['question_type'],$answer_data['question_text'],$answer_data['question_hint'],$answer_data['question_image'],$answer_data['subject_id'],$answer_data['chapter_id'],$answer_data['option_text'],$answer_data['option_is_correct']);

        unset($data['question_image'],$data['option_image'],$data['option_text'],$data['option_is_correct']);
       
       
       try{

            $Section_records =  SectionMaster::where('qp_id',$data['qp_id'])->get(['section_id','number_of_questions_section']);
            $maximum_section_id =  \DB::select(sprintf("SELECT MAX(section_id) as id FROM `section_masters` WHERE qp_id =%s",$data['qp_id']));

            $a=QuestionPaperQuestionsMaster::saveall($data);

            $answer_data['qpq_id'] = $a;



            foreach ($answer_temp_text as $key => $value) {
                if(in_array($key, $correct_answer_key)){
                    $answer_data['is_correct'] = 1;
                    $answer_data['answer_text'] = $answer_temp_text[$key];
                    $b[]=QuestionPaperQuestionAnswersMaster::saveall($answer_data);
                    unset($answer_data['is_correct']);
                    
                }
                else{
                    $answer_data['answer_text'] = $answer_temp_text[$key];

                     $b[]=QuestionPaperQuestionAnswersMaster::saveall($answer_data);
                }
            }
            
             return response()->json([
                "question_id"       => $a,
                "answer_id"         => $b,    
                "section"           => $Section_records,
                 "maximum_section"   => $maximum_section_id,
                "reponseMessage"    => "Question inserted successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Question not inserted ",
                "responseType"      => "failure"
            ], 200);
        }

        
        
    }

     public function update_question(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

         

        $answer_data = $data;

       //return response()->json($data, 200);

        $answer_data['answer_text'] = $answer_data['option_text'] ;

        $correct_answer_key = $answer_data['option_is_correct'];

         $answer_temp_text = $answer_data['answer_text'];

         $answer_temp_id = $answer_data['qpqa_id'];

        unset($answer_data['update_option_image'],$answer_data['_token'],$answer_data['qpqa_id'],$answer_data['option_image'],$answer_data['marks'],$answer_data['answer_text'],$answer_data['question_type'],$answer_data['question_text'],$answer_data['question_hint'],$answer_data['question_image'],$answer_data['subject_id'],$answer_data['chapter_id'],$answer_data['option_text'],$answer_data['option_is_correct']);

        unset($data['update_option_image'],$data['qpqa_id'],$data['_token'],$data['question_image'],$data['option_image'],$data['option_text'],$data['option_is_correct']);

       
       
       try{

        $a = $data['qpq_id'];

            $Section_records =  SectionMaster::where('qp_id',$data['qp_id'])->get(['section_id','number_of_questions_section']);
            
            $maximum_section_id =  \DB::select(sprintf("SELECT MAX(section_id) as id FROM `section_masters` WHERE qp_id =%s",$data['qp_id']));
            
            QuestionPaperQuestionsMaster::where('qpq_id', $data['qpq_id'])->update($data);

            foreach ($answer_temp_text as $key => $value) {
                if(in_array($key, $correct_answer_key)){
                    $answer_data['is_correct'] = 1;
                    $answer_data['answer_text'] = $answer_temp_text[$key];
                    if(isset($answer_temp_id[$key])){
                    QuestionPaperQuestionAnswersMaster::where('qpqa_id', $answer_temp_id[$key])->update($answer_data);
                    
                    }
                    else{
                        $b[]=QuestionPaperQuestionAnswersMaster::saveall($answer_data);
                    }
                    unset($answer_data['is_correct']);
                    
                }
                else{
                    $answer_data['answer_text'] = $answer_temp_text[$key];
                    $answer_data['is_correct'] = 0;
                    if(isset($answer_temp_id[$key])){
                    QuestionPaperQuestionAnswersMaster::where('qpqa_id', $answer_temp_id[$key])->update($answer_data);
                    }
                    else{
                        $b[]=QuestionPaperQuestionAnswersMaster::saveall($answer_data);
                    }
                }
            }
            
            if(!isset($b)){$b=null;}

             return response()->json([
                "question_id"       => $a,
                "updated_answer_id" => $answer_temp_id,
                "created_answer_id" => $b,
                "section"           => $Section_records,
                "maximum_section"   => $maximum_section_id,
                "reponseMessage"    => "Question Updated successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Question not updated try again ",
                "responseType"      => "failure"
            ], 200);
        }

        
        
    }

     public function set_question_option_image_url(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        
        try{
            QuestionPaperQuestionsMaster::where('qpq_id', $data['question_id'])->update(array('question_image' => $data['question']));

        if(isset($data['answer_id'])){
        foreach ( $data['answer_id'] as $key => $value) {
            
           QuestionPaperQuestionAnswersMaster::where('qpqa_id', $value)->update(array('answer_image' => $data['options'][$key]));

           
        }}
            
             return response()->json([
                "reponseMessage"    => "image url updated successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "image url updation failed",
                "responseType"      => "failure"
            ], 200);
        }
        
        
    }

    public function update_section_image_url(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        try{
         SectionMaster::where('section_id', $data['section_id'])->update($data);

        return response()->json([
                "reponseMessage"    => "Image updated successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Image not updated try again ",
                "responseType"      => "failure"
            ], 200);
        }   
    }

    public function update_option_image_url(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
   
        try{
         
         foreach ( $data['qpqa_id'] as $key => $value) {
            
           QuestionPaperQuestionAnswersMaster::where('qpqa_id', $value)->update(array('answer_image' => $data['answer_image'][$key]));
            
            }

        return response()->json([
                "reponseMessage"    => "Image updated successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Image not updated try again ",
                "responseType"      => "failure"
            ], 200);
        }
    }

    public function update_question_image_url(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        try{
         QuestionPaperQuestionsMaster::where('qpq_id', $data['qpq_id'])->update($data);

        return response()->json([
                "reponseMessage"    => "Image updated successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Image not updated try again ",
                "responseType"      => "failure"
            ], 200);
        }   
    }

     public function view_question_paper(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $qp_details =    QuestionPaperMaster::where('qp_id','=',$data['qp_id'])->get(); 
        $section_details =  SectionMaster::get_all_section_data($data['qp_id']);    
        $question_details =  QuestionPaperQuestionsMaster::get_all_question_details($data['qp_id']);            
       

         return response()->json(['qp_details'=>$qp_details,'section_details'=>$section_details,'question_details'=>$question_details], 200); 
        
    }

    public function get_option_details(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

          $option_details =    QuestionPaperQuestionAnswersMaster::where('qp_id','=',$data)->get(); 

         return response()->json(['option_details'=>$option_details], 200); 
        
    }

    public function set_batch(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        $is_exist = BatchMaster::where('batch_degree',$data['batch_degree'])->where('batch_branch',$data['batch_branch'])->where('batch_year',$data['batch_year'])->pluck('batch_id');

        if($is_exist){
             return response()->json([
                "id"                => $is_exist,
                "reponseMessage"    => "Batch already exist",
                "responseType"      => "failure"
            ], 200);
        }        
        
        try{
            $a=BatchMaster::saveall($data);
            
             return response()->json([
                "id"                => $a,
                "reponseMessage"    => "Batch created successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Batch not created",
                "responseType"      => "failure"
            ], 200);
        }

    }

    public function view_batch_details(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $batch_details =    BatchMaster::viewBatch($data);

        return response()->json(["batch_details"=>$batch_details[0]], 200); 
        
        
    }

    public function batchinstance(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $batch_details = BatchMaster::viewBatch($data[0]);

        $batch_details[0]->registered_students = \DB::table('candidate_education_details')->where('degree_subtype',$batch_details[0]->batch_degree)->where('degree_institution',$data[1])->where('degree_course',$batch_details[0]->batch_branch)->where('degree_year_of_passing',$batch_details[0]->batch_year_to)->count();

        

        $test_details = TestMaster::getBatchInstance($data);

        return response()->json(['batch_details'=>$batch_details[0],'test_details'=>$test_details], 200); 


        
    }

    public function edit_batch(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $return_data =    BatchMaster::view_editbatch_detail($data);

        $selected_degree = $return_data[0]->batch_degree;

        $selected_degree_branch = \DB::table('course_master')->where('id','>',0)->where('degree_subtype_id',$selected_degree)->orderBy('course_name', 'ASC')->lists('course_name','id');

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

        return response()->json(["details"=>$return_data,'degree_list'=>$degree_list,'selected_degree_branch'=>$selected_degree_branch], 200); 
        
        
    }

    public function update_batch(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
              
        
        try{
            $a=BatchMaster::updateAll($data);
            
            if($a){
             return response()->json([
                "reponseMessage"    => "Batch updated successfully",
                "responseType"      => "success"
            ], 200);
         }
         else{
            return response()->json([
                "reponseMessage"    => "Batch details updated with same data",
                "responseType"      => "success"
            ], 200);
         }


        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Batch details not updated",
                "responseType"      => "failure"
            ], 200);
        }

    }

    public function export_test_feedback(Request $request){

      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        $tmp = TestMaster::where('test_id',$data)->get(['title','batch_id']);

        $title = $tmp[0]->title;
        $batch_id = $tmp[0]->batch_id;

        $batch_details = BatchMaster::viewBatch($batch_id);
        
        
        $student_feedback = TestStudentFeedbackMaster::where('test_id', $data)->get(['student_id','name','email','message']);

        return response()->json(['title'=>$title,'batch_details'=>$batch_details,'student_feedback'=>$student_feedback], 200);  

        
    }

    public function export_test_report(Request $request){

      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        

        $test_id = $data;
        
        $tmp = TestMaster::where('test_id',$test_id)->get(['title','batch_id','qp_id']);

        $batch_id = $tmp[0]->batch_id;
        
        $batch_details = BatchMaster::viewBatch($batch_id);
        
        
        
        $student_details = CandidateEducationDetail::where('candidate_education_details.degree_institution',$batch_details[0]->college_id)
                        ->where('candidate_education_details.degree_subtype',$batch_details[0]->batch_degree)
                        ->where('candidate_education_details.degree_course',$batch_details[0]->batch_branch)
                        ->where('candidate_education_details.degree_year_of_passing',$batch_details[0]->batch_year_to)
                         ->join('candidate_master', 'candidate_education_details.student_id', '=', 'candidate_master.student_id')
                        ->select('candidate_education_details.student_id','first_name','last_name','email','email')
                        ->get();
        

        $qp_id = $tmp[0]->qp_id;

        $Section_records =  SectionMaster::get_section_details($qp_id);

        $subject = [];
       

        foreach ($Section_records as $srkey => $srvalue) {
            if(!in_array( $srvalue->section_subject, $subject))
                $subject[$srvalue->section_subject_id] = $srvalue->section_subject;
        }
        
        

        foreach ($student_details as $sd_key => $sd_val) {

            $sd_val->login =  StudentTestLoginMaster::where('test_id','=',$test_id)->where('student_id','=',$sd_val->student_id)->pluck('login_time'); 
            $sd_val->logout =  StudentTestLoginMaster::where('test_id','=',$test_id)->where('student_id','=',$sd_val->student_id)->pluck('logout_time');

            foreach ($subject as $sub_key => $sub_value) {

                $tmp_mark_detail = [];

                $tmp_mark_detail = TestReportMaster::where('test_id','=',$test_id)
                                                   ->where('subject_id','=',$sub_key)
                                                   ->where('student_id','=',$sd_val->student_id)
                                                   ->get(['total','correct','incorrect','attended','not_attended']);
                                                  
                
                if( count($tmp_mark_detail) ){  
                $sd_val->$sub_value =   $tmp_mark_detail[0]->correct; 
                $sd_val->correct =   $sd_val->correct + $tmp_mark_detail[0]->correct;
                $sd_val->incorrect =   $sd_val->incorrect + $tmp_mark_detail[0]->incorrect;
                $sd_val->attended =   $sd_val->attended + $tmp_mark_detail[0]->attended;
                $sd_val->not_attended =   $sd_val->not_attended + $tmp_mark_detail[0]->not_attended;
                }
                else{
                    $sd_val->$sub_value =   '-'; 
                $sd_val->correct =   '-';
                $sd_val->incorrect =   '-';
                $sd_val->attended =   '-';
                $sd_val->not_attended =   '-';
                }
            }   

        }
        
        

        $title = $tmp[0]->title;

        return response()->json(['title'=>$title,'batch_details'=>$batch_details,'subject'=>$subject,'student_details'=>$student_details], 200); 

        
    }






}






