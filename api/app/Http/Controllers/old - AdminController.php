<?php namespace App\Http\Controllers;

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

class AdminController extends Controller {
    /**
     * authentication
     */
    public function __construct() {
       // $this->middleware('auth');
    }

    /**
    * Company Registration
    * @param Request $request
    * @return type JSON
    */

// Begin Question paper creation

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
	
	public function get_college(Request $request){
		
		$college_list = \DB::table('institution_master')->where('status',1)->orderBy('name', 'ASC')->lists('name', 'id');
		
		return response()->json(['college_list'=>$college_list], 200);

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

     public function get_chapter(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $Chapter_Records = SubjectMaster::where('reference_id', '=',$data['subject_id'])->orderBy('subject_id', 'ASC')->lists('name', 'subject_id');
        return response()->json($Chapter_Records, 200); 
        
        
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

    public function delete_section(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
       
        try{
            SectionMaster::destroy($data['section_id']);
            
             return response()->json([
                "reponseMessage"    => "Section deleted successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Section not deleted successfully",
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

     public function add_question(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $answer_data = $data;



        $answer_data['answer_text'] = $answer_data['option_text'] ;

        $correct_answer_key = $answer_data['option_is_correct'];

        $answer_temp_text = $answer_data['answer_text'];

        unset($answer_data['option_image'],$answer_data['marks'],$answer_data['answer_text'],$answer_data['question_type'],$answer_data['question_text'],$answer_data['question_image'],$answer_data['subject_id'],$answer_data['chapter_id'],$answer_data['option_text'],$answer_data['option_is_correct']);

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

        unset($answer_data['update_option_image'],$answer_data['_token'],$answer_data['qpqa_id'],$answer_data['option_image'],$answer_data['marks'],$answer_data['answer_text'],$answer_data['question_type'],$answer_data['question_text'],$answer_data['question_image'],$answer_data['subject_id'],$answer_data['chapter_id'],$answer_data['option_text'],$answer_data['option_is_correct']);

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


public function delete_option(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        try{
         QuestionPaperQuestionAnswersMaster::destroy($data['qpqa_id']);

        return response()->json([
                "reponseMessage"    => "Option deleted successfully",
                "responseType"      => "success"
            ], 200);
        }
        catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Option not deleted try again ",
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


// End of Question paper creation

// Begin Test Creation

    public function dashboard_batch_details(Request $request){

     

     $data = $request->json('post');

       if (is_string($data)) {
            $data = json_decode($data, true);
      }
      
       $first_last =  \DB :: select(sprintf("CALL select_test_first_last ('%s','%s')",$data['search_key'],$data['status']));

       $b= BatchMaster::getBatch();

       $count1 = \DB:: select (sprintf("(SELECT (SELECT COUNT(test_id) AS inactive FROM `test_masters` WHERE STATUS = 2) AS test_inactive,(SELECT COUNT(test_id) AS active FROM `test_masters` WHERE STATUS = 1) AS test_active,(SELECT COUNT(test_id) AS finished FROM `test_masters` WHERE STATUS = 3) AS test_finished,(SELECT COUNT(test_id) AS not_Started FROM `test_masters` WHERE STATUS = 0) AS not_Started)"));

       $count2 = \DB:: select (sprintf("(SELECT (SELECT COUNT(qp_id) AS inactive FROM `question_paper_masters` WHERE STATUS = 0) AS qp_inactive,(SELECT COUNT(qp_id) AS active FROM `question_paper_masters` WHERE STATUS = 1) AS qp_active)"));

       return response()->json(["count1"=>$count1,"count2"=>$count2,"first_last"=>$first_last,'batch_details'=>$b], 200);
   
    }

     public function dashboard_questionpaper_details(Request $request){

       $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
       $first_last =  \DB :: select(sprintf("CALL select_questionpaper_first_last ('%s','%s')",$data['search_key'],$data['status']));

       $a= \DB :: select(sprintf("CALL select_questions ('%s','%s','%s','%s')",$data['action'],$data['action_value'],$data['search_key'],$data['status']));

       // $count = \DB:: select (sprintf("(SELECT (SELECT COUNT(qp_id) AS inactive FROM `question_paper_masters` WHERE STATUS = 0) AS qp_inactive,(SELECT COUNT(qp_id) AS active FROM `question_paper_masters` WHERE STATUS = 1) AS qp_active)"));

       $count1 = \DB:: select (sprintf("(SELECT (SELECT COUNT(test_id) AS inactive FROM `test_masters` WHERE STATUS = 2) AS test_inactive,(SELECT COUNT(test_id) AS active FROM `test_masters` WHERE STATUS = 1) AS test_active,(SELECT COUNT(test_id) AS finished FROM `test_masters` WHERE STATUS = 3) AS test_finished,(SELECT COUNT(test_id) AS not_Started FROM `test_masters` WHERE STATUS = 0) AS not_Started)"));

       $count2 = \DB:: select (sprintf("(SELECT (SELECT COUNT(qp_id) AS inactive FROM `question_paper_masters` WHERE STATUS = 0) AS qp_inactive,(SELECT COUNT(qp_id) AS active FROM `question_paper_masters` WHERE STATUS = 1) AS qp_active)"));

       return response()->json(["count1"=>$count1,"count2"=>$count2,"first_last"=>$first_last,'qp_details'=>$a], 200);
   
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
	
	public function getcollege(Request $request){
      
      $college_list = \DB::table('institution_master')->orderBy('name', 'ASC')->lists('name', 'id');
             return response()->json([
                "college_list"                => $college_list,
                "responseType"      => "success"
            ], 200);
       

    }

    public function check_questionpaper(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        

        try{
           $record = QuestionPaperMaster::where('qp_id', $data)->where('status', '=' , '1')->get();
            
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

    public function view_batch_details(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $batch_details =    BatchMaster::viewBatch($data);

        return response()->json(["batch_details"=>$batch_details[0]], 200); 
        
        
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

     public function test_question_details(Request $request){
         
         
        
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $finished_records = TestResponseMaster::where('test_id',$data['test_id'])->where('user_id',$data['user_id'])->get(['section_id','section_order_id','qpq_order_id','qpq_id','status','response_qpqa_id']);
  

        $timetaken = StudentTestLoginMaster::where('test_id', '=', $data['test_id'])->where('user_id', '=', $data['user_id'])->pluck('time_remaining');
		
         return response()->json([            
            'finished_records' => $finished_records,
            'timetaken'=>$timetaken,
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

    public function get_question_paper(Request $request){
        
        
      $id = $request->json('post');
    
        if (is_string($id)) {
            $id = json_decode($id, true);
        }
		
		
         $test_id = $id['test_id'];

         $test_question_records = TestMaster::where('test_id',$test_id)->get(['test_id','qp_id','number_of_questions','total_marks','duration']);

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

    public function testkey(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

         $qp_id=BatchMaster::where('test_id','=',$data)->pluck('qp_id'); 

         $testdetails=BatchMaster::where('test_id','=',$data)->get(); 

         $Section_records =  SectionMaster::get_section_list($qp_id);

         $Question_records =  QuestionPaperQuestionsMaster::where('qp_id',$qp_id)->get(['qpq_id','qpq_order_id','qp_id','section_id','section_order_id','subject_id','question_type','question_text','question_image','answer_type','answer_option_type','marks','terms_condtions','status']);

         $Option_records =  QuestionPaperQuestionAnswersMaster::where('qp_id',$qp_id)->where('is_correct',1)->get(['qpqa_id','section_id','qpq_order_id','answer_image','answer_text','is_correct']);

         return response()->json([
            'testdetails' => $testdetails,
            'Section_records' => $Section_records,
            'Question_records' => $Question_records,
            'Option_records'=>$Option_records
            ], 200); 

        
    }

      public function testreport(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }



        $test_login_id = $data;
        
        $test_id =   TestLoginMaster::where('test_id', $data)->pluck('test_id');

        $qp_id=BatchMaster::where('test_id','=',$test_id)->pluck('qp_id'); 


        $Section_records =  SectionMaster::get_section_details($qp_id);



                $subject = [];
               

                foreach ($Section_records as $srkey => $srvalue) {
                    if(!in_array( $srvalue->section_subject, $subject))
                        $subject[$srvalue->section_subject_id] = $srvalue->section_subject;
                }

            

        $student_details_list = TestResponseMaster::where('test_id','=',$test_login_id)->distinct()->get(['user_id','student_id','test_id']); 


        foreach ($student_details_list as $skey => $svalue) {
            
            $tmp_detail =  \DB :: select(sprintf("select diploma1_percentage,UG1_percentage,PG1_percentage,diploma1_medium,UG1_medium,PG1_medium,work_mode,work_month,first_name,last_name,email,mobile,date_of_birth,gender,phone,preferred_location,work_mode,HSC_course,HSC_percentage,HSC_year_of_completion,HSC_medium,SSLC_course,SSLC_percentage,SSLC_year_of_completion,SSLC_medium,UG1_institution,UG1_course_id,UG1_year_of_completion,PG1_institution,PG1_course_id,PG1_year_of_completion,diploma1_institution,diploma1_course_id,diploma1_year_of_completion from candidate_master where id = (%d)  order by first_name asc",$svalue->student_id));

            $svalue->student_name =$tmp_detail[0]->first_name.' '.$tmp_detail[0]->last_name;
            $svalue->email =$tmp_detail[0]->email;
            $svalue->mobile =$tmp_detail[0]->mobile;
            $svalue->date_of_birth =$tmp_detail[0]->date_of_birth;
            $svalue->gender =$tmp_detail[0]->gender;
            $svalue->phone =$tmp_detail[0]->phone;
            $svalue->preferred_location =(int)$tmp_detail[0]->preferred_location;
            $svalue->work_type = (int) $tmp_detail[0]->work_mode;
            $svalue->work_month =(int)$tmp_detail[0]->work_month;

            $svalue->HSC_percentage =$tmp_detail[0]->HSC_percentage;
            $svalue->HSC_year_of_completion =$tmp_detail[0]->HSC_year_of_completion;
            $svalue->HSC_medium =(int)$tmp_detail[0]->HSC_medium;
            $svalue->HSC_board =(int)$tmp_detail[0]->HSC_course;
            
            $svalue->SSLC_percentage =$tmp_detail[0]->SSLC_percentage;
            $svalue->SSLC_year_of_completion =$tmp_detail[0]->SSLC_year_of_completion;
            $svalue->SSLC_medium =(int)$tmp_detail[0]->SSLC_medium;
            $svalue->SSLC_board =(int)$tmp_detail[0]->SSLC_course;
            
            
            $svalue->diploma1_institution =$tmp_detail[0]->diploma1_institution;
            $svalue->diploma1_course_id =(int)$tmp_detail[0]->diploma1_course_id;
            $svalue->diploma1_year_of_completion =$tmp_detail[0]->diploma1_year_of_completion;
            $svalue->diploma1_medium =(int)$tmp_detail[0]->diploma1_medium;
            $svalue->diploma1_percentage =(int)$tmp_detail[0]->diploma1_percentage;
            
            $svalue->UG1_institution =$tmp_detail[0]->UG1_institution;
            $svalue->UG1_course_id =(int)$tmp_detail[0]->UG1_course_id;
            $svalue->UG1_year_of_completion =$tmp_detail[0]->UG1_year_of_completion;
            $svalue->UG1_medium =(int)$tmp_detail[0]->UG1_medium;
            $svalue->UG1_percentage =(int)$tmp_detail[0]->UG1_percentage;
            
            $svalue->PG1_institution =$tmp_detail[0]->PG1_institution;
            $svalue->PG1_course_id =(int)$tmp_detail[0]->PG1_course_id;
            $svalue->PG1_year_of_completion =$tmp_detail[0]->PG1_year_of_completion;
            $svalue->PG1_medium =(int)$tmp_detail[0]->PG1_medium;
            $svalue->PG1_percentage =(int)$tmp_detail[0]->PG1_percentage;
           
        }
		
		//return response()->json($student_details_list, 200); 





        foreach ($student_details_list as $skey => $svalue) {
            
            $svalue->attempt =  StudentTestLoginMaster::where('test_id','=',$test_login_id)->where('student_id','=',$svalue->student_id)->pluck('login_attempt'); 
			//$svalue->time_lapsed =  StudentTestLoginMaster::where('test_id','=',$test_login_id)->where('student_id','=',$svalue->student_id)->pluck('time_lapsed'); 
			$svalue->login =  StudentTestLoginMaster::where('test_id','=',$test_login_id)->where('student_id','=',$svalue->student_id)->pluck('login_time'); 
            $svalue->logout =  StudentTestLoginMaster::where('test_id','=',$test_login_id)->where('student_id','=',$svalue->student_id)->pluck('logout_time'); 
            
            if($svalue->work_type == 1){$svalue->work_type = "Full Time";}
            else if($svalue->work_type == 2){$svalue->work_type = "Part Time";}
            else if($svalue->work_type == 3){$svalue->work_type = "Internship";}
            else{$svalue->work_type = "";}
            
            if($svalue->work_month == 1){$svalue->work_month = "Available immediately";}
            else if($svalue->work_month == 2){$svalue->work_month = "After Passing out";}
            else{$svalue->work_month = "";}
            
            $svalue->preferred_location = \DB::table('preferred_location_masters')->where('id', $svalue->preferred_location)->pluck('name');
            $svalue->HSC_board  = \DB::table('school_board_masters')->where('id', $svalue->HSC_board )->pluck('name');
            $svalue->SSLC_board  = \DB::table('school_board_masters')->where('id', $svalue->SSLC_board )->pluck('name');
            
            $svalue->SSLC_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->SSLC_medium )->pluck('name');
            $svalue->HSC_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->HSC_medium )->pluck('name');
            $svalue->diploma1_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->diploma1_medium )->pluck('name');
            $svalue->UG1_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->UG1_medium )->pluck('name');
            $svalue->PG1_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->PG1_medium )->pluck('name');
            
             
            $diploma_details  = null;$UG1_details  = null;$PG1_details  = null;
            
            $diploma_details  = \DB::table('course_master')->where('id', $svalue->diploma1_course_id )->get(['degree_subtype_id','name']);
            $UG1_details  = \DB::table('course_master')->where('id', $svalue->UG1_course_id )->get(['degree_subtype_id','name']);
            $PG1_details  = \DB::table('course_master')->where('id', $svalue->PG1_course_id )->get(['degree_subtype_id','name']);
            
            if($diploma_details){$svalue->diploma1_branch  = $diploma_details[0]->name;}else{$svalue->diploma1_degree  = null;$svalue->diploma1_branch  = null;}
            if($UG1_details){
                $svalue->UG1_degree  = \DB::table('degree_subtype')->where('id', $UG1_details[0]->degree_subtype_id )->pluck('name');
                $svalue->UG1_branch  = $UG1_details[0]->name;
                }else{$svalue->UG1_degree  = null;$svalue->UG1_branch  = null;}
            if($PG1_details){
                $svalue->PG1_degree  = \DB::table('degree_subtype')->where('id', $PG1_details[0]->degree_subtype_id )->pluck('name');
                $svalue->PG1_branch  = $PG1_details[0]->name;
                }else{$svalue->PG1_degree  = null;$svalue->PG1_branch  = null;}
            
            
            if($svalue->diploma1_course_id != null){
                $svalue->highest_degree = "Diploma";
            }
            if($svalue->UG1_course_id != null){
                $svalue->highest_degree = "UG";
            }
            if($svalue->PG1_course_id != null){
                $svalue->highest_degree = "PG";
            }
            
            unset($svalue->diploma1_course_id);unset($svalue->UG1_course_id);unset($svalue->PG1_course_id);
        }
        
        $student_answer = TestReportMaster::where('test_id','=',$test_login_id)->get(['test_id','test_id','student_id','subject_id','total','correct','incorrect','attended','not_attended']); 

         $testdetails=BatchMaster::where('test_id','=',$test_id)->get(); 
         $testdetails[0]->testinstance = $test_login_id;

        

        return response()->json([
            'subject' => $subject,
            'testdetails' => $testdetails,
            'student_details_list'=>$student_details_list,
            'student_answer'=>$student_answer,
            ], 200); 

        
    }
    
    public function full_testreport(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $test_id = $data;
		
        $qp_id=BatchMaster::where('test_id','=',$test_id)->pluck('qp_id'); 


        $Section_records =  SectionMaster::get_section_details($qp_id);

                $subject = [];
               

                foreach ($Section_records as $srkey => $srvalue) {
                    if(!in_array( $srvalue->section_subject, $subject))
                        $subject[$srvalue->section_subject_id] = $srvalue->section_subject;
                }

                

        $student_details_list = TestResponseMaster::where('test_id',$test_id)->distinct()->get(['user_id','student_id','test_id']); 

		
        foreach ($student_details_list as $skey => $svalue) {
            
            $tmp_detail =  \DB :: select(sprintf("select diploma1_percentage,UG1_percentage,PG1_percentage,diploma1_medium,UG1_medium,PG1_medium,work_mode,work_month,first_name,last_name,email,mobile,date_of_birth,gender,phone,preferred_location,work_mode,HSC_course,HSC_percentage,HSC_year_of_completion,HSC_medium,SSLC_course,SSLC_percentage,SSLC_year_of_completion,SSLC_medium,UG1_institution,UG1_course_id,UG1_year_of_completion,PG1_institution,PG1_course_id,PG1_year_of_completion,diploma1_institution,diploma1_course_id,diploma1_year_of_completion from candidate_master where id = (%d)  order by first_name asc",$svalue->student_id));

            $svalue->student_name =$tmp_detail[0]->first_name.' '.$tmp_detail[0]->last_name;
            $svalue->email =$tmp_detail[0]->email;
            $svalue->mobile =$tmp_detail[0]->mobile;
            $svalue->date_of_birth =$tmp_detail[0]->date_of_birth;
            $svalue->gender =$tmp_detail[0]->gender;
            $svalue->phone =$tmp_detail[0]->phone;
            $svalue->preferred_location =(int)$tmp_detail[0]->preferred_location;
            $svalue->work_type = (int) $tmp_detail[0]->work_mode;
            $svalue->work_month =(int)$tmp_detail[0]->work_month;

            $svalue->HSC_percentage =$tmp_detail[0]->HSC_percentage;
            $svalue->HSC_year_of_completion =$tmp_detail[0]->HSC_year_of_completion;
            $svalue->HSC_medium =(int)$tmp_detail[0]->HSC_medium;
            $svalue->HSC_board =(int)$tmp_detail[0]->HSC_course;
            
            $svalue->SSLC_percentage =$tmp_detail[0]->SSLC_percentage;
            $svalue->SSLC_year_of_completion =$tmp_detail[0]->SSLC_year_of_completion;
            $svalue->SSLC_medium =(int)$tmp_detail[0]->SSLC_medium;
            $svalue->SSLC_board =(int)$tmp_detail[0]->SSLC_course;
            
            
            $svalue->diploma1_institution =$tmp_detail[0]->diploma1_institution;
            $svalue->diploma1_course_id =(int)$tmp_detail[0]->diploma1_course_id;
            $svalue->diploma1_year_of_completion =$tmp_detail[0]->diploma1_year_of_completion;
            $svalue->diploma1_medium =(int)$tmp_detail[0]->diploma1_medium;
            $svalue->diploma1_percentage =(int)$tmp_detail[0]->diploma1_percentage;
            
            $svalue->UG1_institution =$tmp_detail[0]->UG1_institution;
            $svalue->UG1_course_id =(int)$tmp_detail[0]->UG1_course_id;
            $svalue->UG1_year_of_completion =$tmp_detail[0]->UG1_year_of_completion;
            $svalue->UG1_medium =(int)$tmp_detail[0]->UG1_medium;
            $svalue->UG1_percentage =(int)$tmp_detail[0]->UG1_percentage;
            
            $svalue->PG1_institution =$tmp_detail[0]->PG1_institution;
            $svalue->PG1_course_id =(int)$tmp_detail[0]->PG1_course_id;
            $svalue->PG1_year_of_completion =$tmp_detail[0]->PG1_year_of_completion;
            $svalue->PG1_medium =(int)$tmp_detail[0]->PG1_medium;
            $svalue->PG1_percentage =(int)$tmp_detail[0]->PG1_percentage;
           
        }

        foreach ($student_details_list as $skey => $svalue) {
            
			$svalue->attempt =  StudentTestLoginMaster::where('test_id',$test_id)->where('student_id','=',$svalue->student_id)->pluck('login_attempt'); 
			//$svalue->time_lapsed =  StudentTestLoginMaster::where('test_id',$test_id)->where('student_id','=',$svalue->student_id)->pluck('time_lapsed'); 
            $svalue->login =  StudentTestLoginMaster::where('test_id',$test_id)->where('student_id','=',$svalue->student_id)->pluck('login_time'); 
            $svalue->logout =  StudentTestLoginMaster::where('test_id',$test_id)->where('student_id','=',$svalue->student_id)->pluck('logout_time'); 
            
            if($svalue->work_type == 1){$svalue->work_type = "Full Time";}
            else if($svalue->work_type == 2){$svalue->work_type = "Part Time";}
            else if($svalue->work_type == 3){$svalue->work_type = "Internship";}
            else{$svalue->work_type = "";}
            
            if($svalue->work_month == 1){$svalue->work_month = "Available immediately";}
            else if($svalue->work_month == 2){$svalue->work_month = "After Passing out";}
            else{$svalue->work_month = "";}
            
            $svalue->preferred_location = \DB::table('preferred_location_masters')->where('id', $svalue->preferred_location)->pluck('name');
            $svalue->HSC_board  = \DB::table('school_board_masters')->where('id', $svalue->HSC_board )->pluck('name');
            $svalue->SSLC_board  = \DB::table('school_board_masters')->where('id', $svalue->SSLC_board )->pluck('name');
            
            $svalue->SSLC_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->SSLC_medium )->pluck('name');
            $svalue->HSC_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->HSC_medium )->pluck('name');
            $svalue->diploma1_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->diploma1_medium )->pluck('name');
            $svalue->UG1_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->UG1_medium )->pluck('name');
            $svalue->PG1_medium  = \DB::table('medium_of_instructions_masters')->where('id', $svalue->PG1_medium )->pluck('name');
            
             
            $diploma_details  = null;$UG1_details  = null;$PG1_details  = null;
            
            $diploma_details  = \DB::table('course_master')->where('id', $svalue->diploma1_course_id )->get(['degree_subtype_id','name']);
            $UG1_details  = \DB::table('course_master')->where('id', $svalue->UG1_course_id )->get(['degree_subtype_id','name']);
            $PG1_details  = \DB::table('course_master')->where('id', $svalue->PG1_course_id )->get(['degree_subtype_id','name']);
            
            if($diploma_details){$svalue->diploma1_branch  = $diploma_details[0]->name;}else{$svalue->diploma1_degree  = null;$svalue->diploma1_branch  = null;}
            if($UG1_details){
                $svalue->UG1_degree  = \DB::table('degree_subtype')->where('id', $UG1_details[0]->degree_subtype_id )->pluck('name');
                $svalue->UG1_branch  = $UG1_details[0]->name;
                }else{$svalue->UG1_degree  = null;$svalue->UG1_branch  = null;}
            if($PG1_details){
                $svalue->PG1_degree  = \DB::table('degree_subtype')->where('id', $PG1_details[0]->degree_subtype_id )->pluck('name');
                $svalue->PG1_branch  = $PG1_details[0]->name;
                }else{$svalue->PG1_degree  = null;$svalue->PG1_branch  = null;}
            
            
            if($svalue->diploma1_course_id != null){
                $svalue->highest_degree = "Diploma";
            }
            if($svalue->UG1_course_id != null){
                $svalue->highest_degree = "UG";
            }
            if($svalue->PG1_course_id != null){
                $svalue->highest_degree = "PG";
            }
            
            unset($svalue->diploma1_course_id);unset($svalue->UG1_course_id);unset($svalue->PG1_course_id);
        }
		
		
        
        $student_answer = TestReportMaster::where('test_id',$test_id)->get(['test_id','test_id','student_id','subject_id','total','correct','incorrect','attended','not_attended']); 

         $testdetails=BatchMaster::where('test_id','=',$test_id)->get(); 
         $testdetails[0]->testmain =  $test_id;

        

        return response()->json([
            'subject' => $subject,
            'testdetails' => $testdetails,
            'student_details_list'=>$student_details_list,
            'student_answer'=>$student_answer,
            ], 200); 

        
    }
	
	public function download_college_students(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
            
            $tmp_detail =  \DB :: select(sprintf("select id,diploma1_percentage,UG1_percentage,PG1_percentage,diploma1_medium,UG1_medium,PG1_medium,work_mode,work_month,first_name,last_name,email,mobile,date_of_birth,gender,phone,preferred_location,work_mode,HSC_course,HSC_percentage,HSC_year_of_completion,HSC_medium,SSLC_course,SSLC_percentage,SSLC_year_of_completion,SSLC_medium,UG1_institution,UG1_course_id,UG1_year_of_completion,PG1_institution,PG1_course_id,PG1_year_of_completion,diploma1_institution,diploma1_course_id,diploma1_year_of_completion from candidate_master where institution_id = (%d) order by first_name asc",$data));
			
			 $detail = [];
			 
			foreach ($tmp_detail as $skey => $svalue) {
			
			$detail[$skey]['student_id'] =$svalue->id;
            $detail[$skey]['student_name'] =$svalue->first_name.' '.$svalue->last_name;
            $detail[$skey]['email'] =$svalue->email;
            $detail[$skey]['mobile'] =$svalue->mobile;
            $detail[$skey]['date_of_birth'] =$svalue->date_of_birth;
            $detail[$skey]['gender'] =$svalue->gender;
            $detail[$skey]['phone'] =$svalue->phone;
            $detail[$skey]['preferred_location'] =(int)$svalue->preferred_location;
            $detail[$skey]['work_type'] = (int) $svalue->work_mode;
            $detail[$skey]['work_month'] =(int)$svalue->work_month;

            $detail[$skey]['HSC_percentage'] =$svalue->HSC_percentage;
            $detail[$skey]['HSC_year_of_completion'] =$svalue->HSC_year_of_completion;
            $detail[$skey]['HSC_medium'] =(int)$svalue->HSC_medium;
            $detail[$skey]['HSC_board'] =(int)$svalue->HSC_course;
            
            $detail[$skey]['SSLC_percentage'] =$svalue->SSLC_percentage;
            $detail[$skey]['SSLC_year_of_completion'] =$svalue->SSLC_year_of_completion;
            $detail[$skey]['SSLC_medium'] =(int)$svalue->SSLC_medium;
            $detail[$skey]['SSLC_board'] =(int)$svalue->SSLC_course;
            
            
            $detail[$skey]['diploma1_institution'] =$svalue->diploma1_institution;
            $detail[$skey]['diploma1_course_id'] =(int)$svalue->diploma1_course_id;
            $detail[$skey]['diploma1_year_of_completion'] =$svalue->diploma1_year_of_completion;
            $detail[$skey]['diploma1_medium'] =(int)$svalue->diploma1_medium;
            $detail[$skey]['diploma1_percentage'] =(int)$svalue->diploma1_percentage;
            
            $detail[$skey]['UG1_institution'] =$svalue->UG1_institution;
            $detail[$skey]['UG1_course_id'] =(int)$svalue->UG1_course_id;
            $detail[$skey]['UG1_year_of_completion'] =$svalue->UG1_year_of_completion;
            $detail[$skey]['UG1_medium'] =(int)$svalue->UG1_medium;
            $detail[$skey]['UG1_percentage'] =(int)$svalue->UG1_percentage;
            
            $detail[$skey]['PG1_institution'] =$svalue->PG1_institution;
            $detail[$skey]['PG1_course_id'] =(int)$svalue->PG1_course_id;
            $detail[$skey]['PG1_year_of_completion'] =$svalue->PG1_year_of_completion;
            $detail[$skey]['PG1_medium'] =(int)$svalue->PG1_medium;
            $detail[$skey]['PG1_percentage'] =(int)$svalue->PG1_percentage;
           
        }
		
		foreach ($detail as $dkey => $dvalue) {
            
            
            if($detail[$dkey]['work_type'] == 1){$detail[$dkey]['work_type'] = "Full Time";}
            else if($detail[$dkey]['work_type'] == 2){$detail[$dkey]['work_type'] = "Part Time";}
            else if($detail[$dkey]['work_type'] == 3){$detail[$dkey]['work_type'] = "Internship";}
            else{$detail[$dkey]['work_type'] = "";}
            
            if($detail[$dkey]['work_month'] == 1){$detail[$dkey]['work_month'] = "Available immediately";}
            else if($detail[$dkey]['work_month'] == 2){$detail[$dkey]['work_month'] = "After Passing out";}
            else{$detail[$dkey]['work_month'] = "";}
            
            $detail[$dkey]['preferred_location'] = \DB::table('preferred_location_masters')->where('id', $detail[$dkey]['preferred_location'])->pluck('name');
            $detail[$dkey]['HSC_board']  = \DB::table('school_board_masters')->where('id', $detail[$dkey]['HSC_board'] )->pluck('name');
            $detail[$dkey]['SSLC_board']  = \DB::table('school_board_masters')->where('id', $detail[$dkey]['SSLC_board'] )->pluck('name');
            
            $detail[$dkey]['SSLC_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['SSLC_medium'] )->pluck('name');
            $detail[$dkey]['HSC_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['HSC_medium'] )->pluck('name');
            $detail[$dkey]['diploma1_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['diploma1_medium'] )->pluck('name');
            $detail[$dkey]['UG1_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['UG1_medium'] )->pluck('name');
            $detail[$dkey]['PG1_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['PG1_medium'] )->pluck('name');
            
             
            $diploma_details  = null;$UG1_details  = null;$PG1_details  = null;
            
            $diploma_details  = \DB::table('course_master')->where('id', $detail[$dkey]['diploma1_course_id'] )->get(['degree_subtype_id','name']);
            $UG1_details  = \DB::table('course_master')->where('id', $detail[$dkey]['UG1_course_id'] )->get(['degree_subtype_id','name']);
            $PG1_details  = \DB::table('course_master')->where('id', $detail[$dkey]['PG1_course_id'] )->get(['degree_subtype_id','name']);
            
            if($diploma_details){$detail[$dkey]['diploma1_branch']  = $diploma_details[0]->name;}else{$detail[$dkey]['diploma1_degree']  = null;$detail[$dkey]['diploma1_branch']  = null;}
            if($UG1_details){
                $detail[$dkey]['UG1_degree']  = \DB::table('degree_subtype')->where('id', $UG1_details[0]->degree_subtype_id )->pluck('name');
                $detail[$dkey]['UG1_branch']  = $UG1_details[0]->name;
                }else{$detail[$dkey]['UG1_degree']  = null;$detail[$dkey]['UG1_branch']  = null;}
            if($PG1_details){
                $detail[$dkey]['PG1_degree']  = \DB::table('degree_subtype')->where('id', $PG1_details[0]->degree_subtype_id )->pluck('name');
                $detail[$dkey]['PG1_branch']  = $PG1_details[0]->name;
                }else{$detail[$dkey]['PG1_degree']  = null;$detail[$dkey]['PG1_branch']  = null;}
            
            
            if($detail[$dkey]['diploma1_course_id'] != null){
                $detail[$dkey]['highest_degree'] = "Diploma";
            }
            if($detail[$dkey]['UG1_course_id'] != null){
                $detail[$dkey]['highest_degree'] = "UG";
            }
            if($detail[$dkey]['PG1_course_id'] != null){
                $detail[$dkey]['highest_degree'] = "PG";
            }
            
            unset($detail[$dkey]['diploma1_course_id']);unset($detail[$dkey]['UG1_course_id']);unset($detail[$dkey]['PG1_course_id']);
        }
		
		$title = \DB::table('institution_master')->where('id',$data)->pluck('name');

        return response()->json(['detail'=>$detail,'title'=>$title], 200); 

        
    }
	
	public function download_all_college_students(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
            $colleges = TestLoginMaster::where('test_id',$data)->lists('test_user_id');
			
			$colleges = implode(',',$colleges);
			$colleges = explode(',',$colleges);
			$colleges = array_unique($colleges);
			
			
			$tmp_detail =  \DB::table('candidate_master')->select('id','diploma1_percentage','UG1_percentage','PG1_percentage','diploma1_medium','UG1_medium','PG1_medium','work_mode','work_month','first_name','last_name','email','mobile','date_of_birth','gender','phone','preferred_location','work_mode','HSC_course','HSC_percentage','HSC_year_of_completion','HSC_medium','SSLC_course','SSLC_percentage','SSLC_year_of_completion','SSLC_medium','UG1_institution','UG1_course_id','UG1_year_of_completion','PG1_institution','PG1_course_id','PG1_year_of_completion','diploma1_institution','diploma1_course_id','diploma1_year_of_completion')
							->whereIn('institution_id', $colleges)->get();
			 
			 $detail = [];
			 
			foreach ($tmp_detail as $skey => $svalue) {
			
			$detail[$skey]['student_id'] =$svalue->id;
            $detail[$skey]['student_name'] =$svalue->first_name.' '.$svalue->last_name;
            $detail[$skey]['email'] =$svalue->email;
            $detail[$skey]['mobile'] =$svalue->mobile;
            $detail[$skey]['date_of_birth'] =$svalue->date_of_birth;
            $detail[$skey]['gender'] =$svalue->gender;
            $detail[$skey]['phone'] =$svalue->phone;
            $detail[$skey]['preferred_location'] =(int)$svalue->preferred_location;
            $detail[$skey]['work_type'] = (int) $svalue->work_mode;
            $detail[$skey]['work_month'] =(int)$svalue->work_month;

            $detail[$skey]['HSC_percentage'] =$svalue->HSC_percentage;
            $detail[$skey]['HSC_year_of_completion'] =$svalue->HSC_year_of_completion;
            $detail[$skey]['HSC_medium'] =(int)$svalue->HSC_medium;
            $detail[$skey]['HSC_board'] =(int)$svalue->HSC_course;
            
            $detail[$skey]['SSLC_percentage'] =$svalue->SSLC_percentage;
            $detail[$skey]['SSLC_year_of_completion'] =$svalue->SSLC_year_of_completion;
            $detail[$skey]['SSLC_medium'] =(int)$svalue->SSLC_medium;
            $detail[$skey]['SSLC_board'] =(int)$svalue->SSLC_course;
            
            
            $detail[$skey]['diploma1_institution'] =$svalue->diploma1_institution;
            $detail[$skey]['diploma1_course_id'] =(int)$svalue->diploma1_course_id;
            $detail[$skey]['diploma1_year_of_completion'] =$svalue->diploma1_year_of_completion;
            $detail[$skey]['diploma1_medium'] =(int)$svalue->diploma1_medium;
            $detail[$skey]['diploma1_percentage'] =(int)$svalue->diploma1_percentage;
            
            $detail[$skey]['UG1_institution'] =$svalue->UG1_institution;
            $detail[$skey]['UG1_course_id'] =(int)$svalue->UG1_course_id;
            $detail[$skey]['UG1_year_of_completion'] =$svalue->UG1_year_of_completion;
            $detail[$skey]['UG1_medium'] =(int)$svalue->UG1_medium;
            $detail[$skey]['UG1_percentage'] =(int)$svalue->UG1_percentage;
            
            $detail[$skey]['PG1_institution'] =$svalue->PG1_institution;
            $detail[$skey]['PG1_course_id'] =(int)$svalue->PG1_course_id;
            $detail[$skey]['PG1_year_of_completion'] =$svalue->PG1_year_of_completion;
            $detail[$skey]['PG1_medium'] =(int)$svalue->PG1_medium;
            $detail[$skey]['PG1_percentage'] =(int)$svalue->PG1_percentage;
           
        }
		
		foreach ($detail as $dkey => $dvalue) {
            
            
            if($detail[$dkey]['work_type'] == 1){$detail[$dkey]['work_type'] = "Full Time";}
            else if($detail[$dkey]['work_type'] == 2){$detail[$dkey]['work_type'] = "Part Time";}
            else if($detail[$dkey]['work_type'] == 3){$detail[$dkey]['work_type'] = "Internship";}
            else{$detail[$dkey]['work_type'] = "";}
            
            if($detail[$dkey]['work_month'] == 1){$detail[$dkey]['work_month'] = "Available immediately";}
            else if($detail[$dkey]['work_month'] == 2){$detail[$dkey]['work_month'] = "After Passing out";}
            else{$detail[$dkey]['work_month'] = "";}
            
            $detail[$dkey]['preferred_location'] = \DB::table('preferred_location_masters')->where('id', $detail[$dkey]['preferred_location'])->pluck('name');
            $detail[$dkey]['HSC_board']  = \DB::table('school_board_masters')->where('id', $detail[$dkey]['HSC_board'] )->pluck('name');
            $detail[$dkey]['SSLC_board']  = \DB::table('school_board_masters')->where('id', $detail[$dkey]['SSLC_board'] )->pluck('name');
            
            $detail[$dkey]['SSLC_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['SSLC_medium'] )->pluck('name');
            $detail[$dkey]['HSC_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['HSC_medium'] )->pluck('name');
            $detail[$dkey]['diploma1_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['diploma1_medium'] )->pluck('name');
            $detail[$dkey]['UG1_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['UG1_medium'] )->pluck('name');
            $detail[$dkey]['PG1_medium']  = \DB::table('medium_of_instructions_masters')->where('id', $detail[$dkey]['PG1_medium'] )->pluck('name');
            
             
            $diploma_details  = null;$UG1_details  = null;$PG1_details  = null;
            
            $diploma_details  = \DB::table('course_master')->where('id', $detail[$dkey]['diploma1_course_id'] )->get(['degree_subtype_id','name']);
            $UG1_details  = \DB::table('course_master')->where('id', $detail[$dkey]['UG1_course_id'] )->get(['degree_subtype_id','name']);
            $PG1_details  = \DB::table('course_master')->where('id', $detail[$dkey]['PG1_course_id'] )->get(['degree_subtype_id','name']);
            
            if($diploma_details){$detail[$dkey]['diploma1_branch']  = $diploma_details[0]->name;}else{$detail[$dkey]['diploma1_degree']  = null;$detail[$dkey]['diploma1_branch']  = null;}
            if($UG1_details){
                $detail[$dkey]['UG1_degree']  = \DB::table('degree_subtype')->where('id', $UG1_details[0]->degree_subtype_id )->pluck('name');
                $detail[$dkey]['UG1_branch']  = $UG1_details[0]->name;
                }else{$detail[$dkey]['UG1_degree']  = null;$detail[$dkey]['UG1_branch']  = null;}
            if($PG1_details){
                $detail[$dkey]['PG1_degree']  = \DB::table('degree_subtype')->where('id', $PG1_details[0]->degree_subtype_id )->pluck('name');
                $detail[$dkey]['PG1_branch']  = $PG1_details[0]->name;
                }else{$detail[$dkey]['PG1_degree']  = null;$detail[$dkey]['PG1_branch']  = null;}
            
            
            if($detail[$dkey]['diploma1_course_id'] != null){
                $detail[$dkey]['highest_degree'] = "Diploma";
            }
            if($detail[$dkey]['UG1_course_id'] != null){
                $detail[$dkey]['highest_degree'] = "UG";
            }
            if($detail[$dkey]['PG1_course_id'] != null){
                $detail[$dkey]['highest_degree'] = "PG";
            }
            
            unset($detail[$dkey]['diploma1_course_id']);unset($detail[$dkey]['UG1_course_id']);unset($detail[$dkey]['PG1_course_id']);
        }
		
		$title = \DB::table('institution_master')->where('id',$data)->pluck('name');

        return response()->json(['detail'=>$detail,'title'=>$title], 200); 

        
    }
	
	public function export_feedback(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		
		$title = BatchMaster::where('test_id', $data)->pluck('title');
		
		$college_feedback = TestAdminFeedbackMaster::where('test_id', $data)->get(['test_id','test_user_id','message']);
		
		$student_feedback = TestStudentFeedbackMaster::where('test_id', $data)->get(['test_id','student_id','name','email','message']);

        return response()->json(['title'=>$title,'college_feedback'=>$college_feedback,'student_feedback'=>$student_feedback], 200);  

        
    }

    
     public function testadmin_testreport(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $test_login_id = $data[0];

        try{
        
        $tmp_test_details =   TestLoginMaster::where('test_id', $data[0])->get(['test_id','test_user_id']);

        $test_id = $tmp_test_details[0]->test_id;

        $test_user_id = $tmp_test_details[0]->test_user_id;

        if($test_user_id == $data[1]){

        $qp_id=BatchMaster::where('test_id','=',$test_id)->pluck('qp_id'); 


                $Section_records =  SectionMaster::get_section_details($qp_id);

                $subject = [];
               

                foreach ($Section_records as $srkey => $srvalue) {
                    if(!in_array( $srvalue->section_subject, $subject))
                        $subject[$srvalue->section_subject_id] = $srvalue->section_subject;
                }

                

        $student_details_list = TestResponseMaster::where('test_id','=',$test_login_id)->distinct()->get(['user_id','student_id']); 

        foreach ($student_details_list as $skey => $svalue) {
            
            $tmp_detail =  \DB :: select(sprintf("select first_name,last_name,email,mobile,date_of_birth,gender,phone,preferred_location,HSC_percentage,HSC_year_of_completion,HSC_medium,SSLC_percentage,SSLC_year_of_completion,SSLC_medium,UG1_institution,UG1_course_id,UG1_year_of_completion from candidate_master where id = (%d)  order by first_name asc",$svalue->student_id));

            $svalue->student_name =$tmp_detail[0]->first_name.' '.$tmp_detail[0]->last_name;
            $svalue->email =$tmp_detail[0]->email;
            $svalue->mobile =$tmp_detail[0]->mobile;
            $svalue->date_of_birth =$tmp_detail[0]->date_of_birth;
            $svalue->gender =$tmp_detail[0]->gender;
            $svalue->phone =$tmp_detail[0]->phone;
            $svalue->preferred_location =$tmp_detail[0]->preferred_location;

            $svalue->HSC_percentage =$tmp_detail[0]->HSC_percentage;
            $svalue->HSC_year_of_completion =$tmp_detail[0]->HSC_year_of_completion;
            $svalue->HSC_medium =$tmp_detail[0]->HSC_medium;
            
            $svalue->SSLC_percentage =$tmp_detail[0]->SSLC_percentage;
            $svalue->SSLC_year_of_completion =$tmp_detail[0]->SSLC_year_of_completion;
            $svalue->SSLC_medium =$tmp_detail[0]->SSLC_medium;
            
            $svalue->UG1_institution =$tmp_detail[0]->UG1_institution;
            $svalue->UG1_course_id =$tmp_detail[0]->UG1_course_id;
            $svalue->UG1_year_of_completion =$tmp_detail[0]->UG1_year_of_completion;
           
        }

        foreach ($student_details_list as $skey => $svalue) {
            $svalue->login =  StudentTestLoginMaster::where('test_id','=',$test_login_id)->where('student_id','=',$svalue->student_id)->pluck('login_time'); 
            $svalue->logout =  StudentTestLoginMaster::where('test_id','=',$test_login_id)->where('student_id','=',$svalue->student_id)->pluck('logout_time'); 
        }
        
        $student_answer = TestReportMaster::where('test_id','=',$test_login_id)->get(['test_id','test_id','student_id','subject_id','total','correct','incorrect','attended','not_attended']); 

         $testdetails=BatchMaster::where('test_id','=',$test_id)->get(); 
         $testdetails[0]->testinstance = $test_login_id;

        

        return response()->json([
            'subject' => $subject,
            'testdetails' => $testdetails,
            'student_details_list'=>$student_details_list,
            'student_answer'=>$student_answer,
            "responseType"      => "success"
            ], 200); }

        else{
            return response()->json([
                     "reponseMessage"    => "Sorry ! Authentication failed",
                     "responseType"      => "failure"
                    ], 200); 
        }

    }

    catch(\Exception $e) {
            return response()->json([
                     "reponseMessage"    => "Sorry ! Authentication failed",
                     "responseType"      => "failure"
                    ], 200); 
        }

        
    }

    public function individual_testreport(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $test_id =   TestLoginMaster::where('test_id', $data['test_id'])->pluck('test_id');
        
        $qp_id=BatchMaster::where('test_id','=',$test_id)->pluck('qp_id'); 

        $test_log =  StudentTestLoginMaster::where('test_id','=',$data['test_id'])->where('student_id','=',$data['student_id'])->get(['user_id','student_id','login_time','logout_time']); 
        

        $tmp_name = \DB :: select(sprintf("select first_name from candidate_master where id = (%d)",$data['student_id']));

        $test_log[0]->name = $tmp_name[0]->first_name;

        $student_answer = TestResponseMaster::where('test_id','=',$data['test_id'])->where('student_id','=',$data['student_id'])->get(['student_id','test_id','test_id','qp_id','section_id','section_order_id','qpq_order_id','qpq_id','currect_qpqa_id','response_qpqa_id','created_on']); 

        foreach ($student_answer as $key => $value) {
            $value->currect_qpqa_id =  QuestionPaperQuestionAnswersMaster::where('qpq_id',$value->qpq_id)->where('is_correct',1)->pluck('qpqa_id');
            if($value->currect_qpqa_id == $value->response_qpqa_id){
                $value->is_correct = 1;
            }
            else{
                $value->is_correct = 0;
            }
        }

        $Section_records =  SectionMaster::get_section_list($qp_id);

        $Question_records =  QuestionPaperQuestionsMaster::where('qp_id',$qp_id)->get(['qpq_id','qpq_order_id','qp_id','section_id','section_order_id','subject_id','question_type','question_text','question_image','answer_type','answer_option_type','marks','terms_condtions','status']);

        foreach ($Question_records as $qkey => $qvalue) {
          $qvalue->section_subject = SubjectMaster::where('subject_id',$qvalue->subject_id)->pluck('name');
        }
            
 

        return response()->json([
            'Section_records'   => $Section_records,
            'Question_records'  =>$Question_records,
            'student_answer'    =>$student_answer,
            'test_log'          =>$test_log,
            ], 200); 
    }

     public function testadmin_logout(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $test_detail =   TestLoginMaster::where('test_id', $data['test_id'])->get(['test_id','test_user','test_password']);

        if($test_detail[0]->test_user == $data['test_user'] && $test_detail[0]->test_password == $data['test_password'] ){
              
              $data['logout_time'] = Carbon::now();
              $data['status'] = 2;

            try{
                TestLoginMaster::where('test_id','=',$data['test_id'])->update($data);
                StudentTestLoginMaster::where('test_id','=',$data['test_id'])->where('logout_time',null)->update(['logout_time'=>$data['logout_time']]);

             return response()->json([
                "test_id"           => $test_detail[0]->test_id, 
                "reponseMessage"    => "Successfully Logged out",
                "responseType"      => "Success"
            ], 200);
         }
         catch(\Exception $e) {
            return response()->json([
                "reponseMessage"    => "Logout failure Try again !",
                "responseType"      => "failure"
            ], 200);
        }


        }
        else{
           return response()->json([
                "reponseMessage"    => "Incorrect User Name or Password ",
                "responseType"      => "failure"
            ], 200);
        }
        
        
    }

    public function endtestinstance(Request $request){
      $data = $request->json('post'); 
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
              
              $data['logout_time'] = Carbon::now();
              $data['status'] = 2;

             $test_details = TestLoginMaster::where('test_id',$data['test_id'])->get(['test_id','qp_id']);
				
			$test_id = $test_details[0]->test_id;
			$test_login_id = (int)$data['test_id'];
			$qp_id = $test_details[0]->qp_id;
			
			$students_list =   StudentTestLoginMaster::get_attended_students_list($test_login_id);
			
			$subject_list =  SectionMaster::get_questionpaper_subject_list($qp_id);
			
			$report_status = TestReportMaster::generate_report($test_id,$test_login_id,$students_list,$subject_list);
			
			
            try{
                TestLoginMaster::where('test_id',$data['test_id'])->update($data);

             return response()->json([
				"test_id" 			=> $test_id,
				"success_count"		=> $report_status,
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

    public function testadmin_endtest(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $now = Carbon::now();

        $test_id = TestLoginMaster::where('test_id',$data['test_id'])->pluck('test_id');
            
                $qp_id = BatchMaster::where('test_id',$test_id)->pluck('qp_id');

                $Section_records =  SectionMaster::get_section_details($qp_id);
                
                $subject = [];
               
                foreach ($Section_records as $srkey => $srvalue) {
                    if(!in_array( $srvalue->section_subject, $subject))
                        $subject[] = $srvalue->section_subject;
                }
            
              $test_report_data =    TestResponseMaster::get_test_report($data['test_id']);
              
              if(count($test_report_data) == 0){
                  return response()->json([
                "reponseMessage"    => "Can't end the test None of the Students logged in",
                "responseType"      => "failure"
                    ], 200);
              }

              $test_report_id  =    TestReportMaster::save_report_before_delete($test_report_data,$subject);


        try{

            $a = TestLoginMaster::where('test_id', $data['test_id'])->where('logout_time',null)->update(['logout_time'=>$now,'status'=>2]);  
          
            if($a){
          return response()->json([
                "reponseMessage"    => "Test Ended Successfully",
                "responseType"      => "success"
            ], 200);}
          else{

            return response()->json([
                "reponseMessage"    => "Test Ended Already ",
                "responseType"      => "failure"
            ], 200);


          }

        } 
        catch(\Exception $e) {

            return response()->json([
                "reponseMessage"    => "Error in ending the test",
                "responseType"      => "failure"
            ], 200);

        }


    }
	
	public function delete_test(Request $request){
		
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		
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

    public function testadmin_feedback(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

            try{
                TestAdminFeedbackMaster::create($data);

             return response()->json([
                "reponseMessage"    => "Thank you ! Feedback sent Successfully ... Click on &nbsp;<span class='glyphicon glyphicon-print'></span>&nbsp; Result Tab to View / Export test report",
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


     public function check_token(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $remember_token = \DB::table('users')->where('id', '=', $data[0])->pluck('remember_token');


        if($remember_token){

            $remember_question = StudentTestLoginMaster::where('user_id', $data[0])->where('test_id', $data[2])->pluck('remember_question');

            $token = $remember_token;

            $user = JWTAuth::toUser($token);

            return response()->json([
                'token'             => $token,
                'user'              => $user,
                'remember_question' => $remember_question,
                "reponseMessage"    => "Token Exist",
                "responseType"      => "success"
            ], 200);
        }
            
        else{
            return response()->json([
                "reponseMessage"    => "Token expired",
                "responseType"      => "failure"
            ], 200);
        }
        }
    
      public function testadmin_starttest(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $now = Carbon::now();


        try{

            $a = TestLoginMaster::where('test_id', $data['test_id'])->where('login_time',null)->update(['login_time'=>$now,'status'=>1]);  
          
            if($a){
          return response()->json([
                "reponseMessage"    => "Test Started Successfully",
                "responseType"      => "success"
            ], 200);}
          else{

            return response()->json([
                "reponseMessage"    => "Test Already Started ",
                "responseType"      => "failure"
            ], 200);


          }

        } 
        catch(\Exception $e) {

            return response()->json([
                "reponseMessage"    => "Error in starting the test",
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

    

    public function reappear_student(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		

        $student_id = \DB::table('users')->where('email', '=', $data['email'])->pluck('id');  

        $now = Carbon::now();

        $login_attempt = StudentTestLoginMaster::where('user_id', $student_id)->pluck('login_attempt'); 
            
        
        

            $update_data = ['can_reappear'=>1,'is_login'=>0,'login_attempt'=>$login_attempt+1];
			
			$tmp_reappear_reason = StudentTestLoginMaster::where('user_id', $student_id)->where('test_id', $data['test_id'])->pluck('reappear_reason');

            if($tmp_reappear_reason){
				
                 $update_data['reappear_reason'] = $data['reason'].','.$tmp_reappear_reason;
            }
			else{
				$update_data['reappear_reason'] = $data['reason'];
			}
			
			//return response()->json($update_data, 200); 


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

    public function testadmin_viewstudents(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		
		

        $testlogin_user_id = TestLoginMaster::where('test_id',$data['test_id'])->pluck('test_user_id');

        if($testlogin_user_id == $data['test_user_id'] || $data['test_user_id'] == 2 ){
        
            $test_login_detail = TestLoginMaster::where('test_id',$data['test_id'])->get(['test_id','students_count']);

            $test_details = BatchMaster::where('test_id',$test_login_detail[0]->test_id)->get(['test_id','title','number_of_questions','total_marks','duration']);

            $test_details[0]->testinstance  = $data['test_id'];
			
			$degree  = TestLoginMaster::where('test_id',$data['test_id'])->pluck('test_degree_id');
			
			$branch = TestLoginMaster::where('test_id',$data['test_id'])->pluck('test_branch_id');
			
            $test_details[0]->degree  =  \DB::table('degree_subtype')->where('id',$degree)->pluck('name');
            
            $test_details[0]->branch  = \DB::table('course_master')->where('id',$branch)->pluck('name');
			
            
            $test_details[0]->total_students  = $test_login_detail[0]->students_count;

            $student_details = StudentTestLoginMaster::where('test_id',$data['test_id'])->get(['user_id','student_id','login_attempt','login_time','logout_time','status']);

            foreach ($student_details as $key => $value) {
                $tmp =  \DB::table('users')->where('reg_id',$value->student_id)->get(['name','email']);
				
                $value->name = $tmp[0]->name;
                $value->email =$tmp[0]->email;
            }

            return response()->json([
                "test_details"   => $test_details,
                "student_details"   => $student_details,
                "reponseMessage"    => "Success",
                "responseType"      => "success"
            ], 200);

        }
        else{

             return response()->json([
                "reponseMessage"    => "Sorry ! Authentication failed",
                "responseType"      => "failure"
            ], 200);

        }



    }
	
	public function admin_viewstudents(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		
		

        $testlogin_user_id = TestLoginMaster::where('test_id',$data['test_id'])->pluck('test_user_id');

            $test_login_detail = TestLoginMaster::where('test_id',$data['test_id'])->get(['test_id','students_count']);

            $test_details = BatchMaster::where('test_id',$test_login_detail[0]->test_id)->get(['test_id','title','number_of_questions','total_marks','duration']);

            $test_details[0]->testinstance  = $data['test_id'];
			
			$test_details[0]->qp_id =  BatchMaster::where('test_id',$test_details[0]->test_id)->pluck('qp_id');
			
			$degree  = TestLoginMaster::where('test_id',$data['test_id'])->pluck('test_degree_id');
			
			$branch = TestLoginMaster::where('test_id',$data['test_id'])->pluck('test_branch_id');
			
            $test_details[0]->degree  =  \DB::table('degree_subtype')->where('id',$degree)->pluck('name');
            
            $test_details[0]->branch  = \DB::table('course_master')->where('id',$branch)->pluck('name');
			
            $test_details[0]->total_students  = $test_login_detail[0]->students_count;
			
			$questionpaper_subject_list =  SectionMaster::get_questionpaper_subject_list($test_details[0]->qp_id);

            $student_details = StudentTestLoginMaster::where('test_id',$data['test_id'])->get(['user_id','student_id','login_attempt','login_time','logout_time','status']);

            foreach ($student_details as $key => $value) {
                
				$tmp =  \DB::table('users')->where('reg_id',$value->student_id)->get(['name','email']);
				$value->name = $tmp[0]->name;
                $value->email =$tmp[0]->email;
				
				$mark_detail = \DB::select(sprintf("SELECT COUNT(test_response_id) AS attended,SUM(is_correct) AS correct FROM `test_response_masters` WHERE student_id = %d AND test_login_id = %d",$value->student_id,$test_details[0]->testinstance));
				
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
	
	public function batchinstance(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $batch_details = BatchMaster::viewBatch($data);


        $batch_details[0]->registered_students = \DB::table('candidate_education_details')->where('degree_subtype',$batch_details[0]->batch_degree)->where('degree_course',$batch_details[0]->batch_branch)->where('degree_year_of_passing',$batch_details[0]->batch_year)->count();

        $batch_details[0]->feedback = \DB::table('test_student_feedback_masters')->where('batch_id',$data)->count();

        $test_details = TestMaster::getBatchInstance($data);


        return response()->json(['batch_details'=>$batch_details[0],'test_details'=>$test_details], 200); 


        
    }

   
public function testlogin_details(Request $request){
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		
		$test_id = BatchMaster::where('test_user_id',$data)->pluck('test_id');
        
		$test_login_id=TestLoginMaster::where('test_id',$test_id)->get(['test_user_id','test_degree_id','test_branch_id','title','test_id','created_on','login_time','logout_time','students_count']); 
		
		$college_id = TestLoginMaster::where('test_id','=',$test_id)->pluck('test_user_id'); 
		
		$college_name = BatchMaster::where('test_user_id',$data)->pluck('title'); 
		
		$registered_students =  \DB :: select(sprintf("select count(*) as count from candidate_master where institution_id = (%d) ",$college_id));
		
		$test_taken = StudentTestLoginMaster::where('test_id',$test_id)->count();
		
		$feedback = TestStudentFeedbackMaster::where('test_id',$test_id)->count();
		
		if($registered_students){
		$total = $registered_students[0]->count;}
		else{
			$total = 0;
		}

        foreach ($test_login_id as $tlkey => $tlvalue) {
            
            $test_login_id[$tlkey]->test_user_name = \DB::table('institution_master')->where('id',$test_login_id[$tlkey]->test_user_id)->pluck('name');
			
			$test_login_id[$tlkey]->test_user_POname = \DB::table('institution_master')->where('id',$test_login_id[$tlkey]->test_user_id)->pluck('PO1_name');
			
			$test_login_id[$tlkey]->test_user_email = \DB::table('institution_master')->where('id',$test_login_id[$tlkey]->test_user_id)->pluck('email');
			
			$test_login_id[$tlkey]->test_user_phone = \DB::table('institution_master')->where('id',$test_login_id[$tlkey]->test_user_id)->pluck('PO1_phone');
			
			$test_login_id[$tlkey]->test_user_cell = \DB::table('institution_master')->where('id',$test_login_id[$tlkey]->test_user_id)->pluck('PO1_mobile1');
            
            $test_login_id[$tlkey]->test_degree_id = \DB::table('degree_subtype')->where('id',$test_login_id[$tlkey]->test_degree_id)->pluck('name');
            
            $test_login_id[$tlkey]->test_branch_id = \DB::table('course_master')->where('id',$test_login_id[$tlkey]->test_branch_id)->pluck('name');
            
            $test_login_id[$tlkey]->loggedin_count = StudentTestLoginMaster::where('test_id','=',$test_login_id[$tlkey]->test_login_id)->count();            

            $test_login_id[$tlkey]->active_count = StudentTestLoginMaster::where('test_id','=',$test_login_id[$tlkey]->test_login_id)->where('logout_time','=',null)->count();

            $test_login_id[$tlkey]->loggedout_count = StudentTestLoginMaster::where('test_id','=',$test_login_id[$tlkey]->test_login_id)->where('logout_time','!=','(NULL)')->count();
        }

        return response()->json(['feedback'=>$feedback,'details'=>$test_login_id,'college_id'=>$college_id,'college_name'=>$college_name,'registered_students'=>$total,'test_taken'=>$test_taken], 200); 

    }

    public function testlogin_check(Request $request){
		
        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		

        $testlogin_details = TestLoginMaster::where('test_id',$data['id'])->get(['title','test_id','test_id','test_user_id','test_degree_id','test_branch_id','test_year','status']);


        if(count($testlogin_details) == 0){
          return response()->json([
                     "reponseMessage"    => "Test Not active , Try again Later !!! ",
                     "responseType"      => "failure"
                    ], 200); 
        }
		
		$testlogin_details[0]->test_user_id = explode(',',$testlogin_details[0]->test_user_id);
		$testlogin_details[0]->test_degree_id = explode(',',$testlogin_details[0]->test_degree_id);
		$testlogin_details[0]->test_branch_id = explode(',',$testlogin_details[0]->test_branch_id);
		$testlogin_details[0]->test_year = explode(',',$testlogin_details[0]->test_year);
		$testlogin_details[0]->degree_type = \DB::table('degree_subtype')->whereIn('id',$testlogin_details[0]->test_degree_id)->distinct()->lists('degree_type_id');
		
		
        if(count($testlogin_details) == 0){

            return response()->json(["responseType"      => "success",'test_status'=>3], 200);
        }
		else{
			$status = $testlogin_details[0]->status;
		}

        if($status == 2){

            return response()->json(["responseType"      => "success",'test_status'=>2], 200);
        }

        if($status == 0){

            return response()->json(["responseType"      => "success",'test_status'=>0], 200);
        }
		
		$student_details = \DB::table('candidate_master')->where('email',$data['email'])->get(['id','institution_id','diploma1_course_id','diploma1_year_of_completion','UG1_course_id','UG1_year_of_completion','PG1_course_id','PG1_year_of_completion']);
        
        if(count($student_details) == 0){
            return response()->json(["responseType"      => "success",'testlogin_details'=>$testlogin_details[0],'test_status'=>4], 200);
        }
		
		
        $year_match = 1;$college_match = 1;$degree_match = 1;$branch_match = 1;
		
		//return response()->json($testlogin_details[0]->test_user_id, 200);  
		
		if(!in_array(0,$testlogin_details[0]->test_user_id)){
			if(!in_array($student_details[0]->institution_id,$testlogin_details[0]->test_user_id)){
				if($student_details[0]->institution_id != 99999)
					{$college_match = 0;}
			}
		}
		
		$student_year = 0;
		
		if(in_array(26,$testlogin_details[0]->degree_type) && ($student_details[0]->diploma1_year_of_completion != null) ){
             $student_year = $student_details[0]->diploma1_year_of_completion;
         }
         if(in_array(20,$testlogin_details[0]->degree_type) && ($student_details[0]->UG1_year_of_completion != null) ){
             $student_year = $student_details[0]->UG1_year_of_completion;
         }
         if(in_array(21,$testlogin_details[0]->degree_type) && ($student_details[0]->PG1_year_of_completion != null) ){
             $student_year = $student_details[0]->PG1_year_of_completion;
         }
		 
		 if(!in_array(0,$testlogin_details[0]->test_year)){
			 
		 if(!in_array($student_year,$testlogin_details[0]->test_year)){
			$year_match = 0;
		}
		 }
		
		$student_branch = [(int)$student_details[0]->diploma1_course_id,(int)$student_details[0]->UG1_course_id,(int)$student_details[0]->PG1_course_id];

        foreach ($student_branch as $sbkey => $sbvalue) {
            if($sbvalue != null){

             $student_degree[] = \DB::table('course_master')->where('id', $sbvalue)->pluck('degree_subtype_id');

            }
        }
		
		if(!in_array(0,$testlogin_details[0]->test_degree_id)){
		$is_degree_eligible = array_intersect($student_degree,$testlogin_details[0]->test_degree_id);
		
		if(!count($is_degree_eligible)){
            $degree_match = 0;
        }
		}
		
		if(!in_array(0,$testlogin_details[0]->test_branch_id)){
		$is_branch_eligible = array_intersect($student_branch,$testlogin_details[0]->test_branch_id);
		
		if(!count($is_branch_eligible)){
            $branch_match = 0;
        }}

         return response()->json(["reponseMessage"    => "Test active", "responseType"=> "success",'test_name'=>$testlogin_details[0]->title,'test_status'=>$status,'college_match'=>$college_match,'degree_match'=>$degree_match,'branch_match'=>$branch_match,'year_match'=>$year_match], 200);

    }

    public function get_college_degree(Request $request){

        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
		
		//return response()->json($data['institution_id'], 200);

         $branch = \DB::table('institution_degree')->whereIn('institution_id', $data['institution_id'])->distinct()->get(['degree_id']);

         foreach ($branch as $bkey => $bvalue) {
               $degree_tmp1[] = \DB::table('course_master')->where('id', $bvalue->degree_id)->pluck('degree_subtype_id');
           }  

           $degree1 = array_unique($degree_tmp1);

           asort($degree1);

           foreach ($degree1 as $dkey1 => $dvalue1) {
               $degree[] = $dvalue1;
           }

            $degree_list['ug'] = []; $ug = 0;
            $degree_list['pg'] = []; $pg = 0;
            $degree_list['diploma'] = []; $diploma = 0;

           foreach ($degree as $dkey => $dvalue) {
               
               $degree_type1 = \DB::table('degree_subtype')->where('id', $dvalue)->pluck('degree_type_id');
               
               $degree_type_tmp[] = $degree_type1;
               
               if($degree_type1 == 26){
            
                $degree_list['diploma'][$diploma]['id'] = \DB::table('degree_subtype')->where('id', $dvalue)->pluck('id');

               $degree_list['diploma'][$diploma]['name'] = \DB::table('degree_subtype')->where('id', $dvalue)->pluck('name');

               $diploma++;
               
               }

               if($degree_type1 == 20){

               $degree_list['ug'][$ug]['id'] = \DB::table('degree_subtype')->where('id', $dvalue)->pluck('id');

               $degree_list['ug'][$ug]['name'] = \DB::table('degree_subtype')->where('id', $dvalue)->pluck('name');

               $ug++;

                }

               if($degree_type1 == 21){

                $degree_list['pg'][$pg]['id'] = \DB::table('degree_subtype')->where('id', $dvalue)->pluck('id');

               $degree_list['pg'][$pg]['name'] = \DB::table('degree_subtype')->where('id', $dvalue)->pluck('name');

               $pg++;
               
               }
           }  

           return response()->json(['degree_list'=>$degree_list], 200);


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



    public function get_college_branch(Request $request){

        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

         $institute_branch_tmp= \DB::table('institution_degree')->whereIn('institution_id', $data['institution_id'])->distinct()->get(['degree_id']);

         foreach ($data['degree_id'] as $key => $value) {
                
                $selected_degree[$key]['id'] = $value;

                $selected_degree[$key]['name'] = \DB::table('degree_subtype')->where('id', $value)->pluck('name');
            }


         foreach ($institute_branch_tmp as $ikey => $ivalue) {
             $institute_branch[] = $ivalue->degree_id;
         }

         foreach ($selected_degree as $dkey => $dvalue) {

               $branch_of_degree = \DB::table('admin_course_master')->where('degree_subtype_id', $dvalue['id'])->get(['id']);

                foreach ($branch_of_degree as $bdkey => $bdvalue) {
                    if(in_array($bdvalue->id, $institute_branch)){

                            $branch_tmp = \DB::table('admin_course_master')->where('id', $bdvalue->id)->pluck('name');

                            $college_branch_by_degree[$dvalue['name']][$bdvalue->id] = $branch_tmp;
                    }
                }

           }  

            return response()->json($college_branch_by_degree, 200);

    }

	public function get_branch(Request $request){

        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
//return response()->json($data, 200);
        
         foreach ($data['degree_id'] as $key => $value) {
                
                $selected_degree[$key]['id'] = $value;

                $selected_degree[$key]['name'] = \DB::table('degree_subtype')->where('id', $value)->pluck('name');
            }


         foreach ($selected_degree as $dkey => $dvalue) {

               $branch_of_degree = \DB::table('admin_course_master')->where('degree_subtype_id', $dvalue['id'])->get(['id']);

                foreach ($branch_of_degree as $bdkey => $bdvalue) {
                   
                            $branch_tmp = \DB::table('admin_course_master')->where('id', $bdvalue->id)->pluck('name');
                            $branch_by_degree[$dvalue['name']][$bdvalue->id] = $branch_tmp;
                    
                }

           }  

            return response()->json($branch_by_degree, 200);

    }

     public function get_degree_branch(Request $request){

        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $data = \DB::table('course_master')->where('degree_subtype_id',$data['degree_id'])->orderBy('name', 'ASC')->lists('name', 'id');

            return response()->json($data, 200);

    }

    public function update_remaining_time(Request $request){

        $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $a = StudentTestLoginMaster::where('user_id',$data['user_id'])->where('test_id',$data['test_id'])->update(["time_remaining"=>$data['time_remaining']]);

            return response()->json($a, 200);

    }


    public function signup(Request $request){
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }


        $languge_details = \DB::table('medium_of_instructions_masters')->orderBy('name', 'ASC')->lists('name', 'id');
        $university_details = \DB::table('university_master')->orderBy('name', 'ASC')->lists('name', 'id');
		
		
		$test_data = TestLoginMaster::where('test_id',$data['test_id'])->get(['test_user_id','test_degree_id','test_branch_id','test_year']);
		
		$data['college_id'] = $test_data[0]->test_user_id;
		$data['degree_id'] = $test_data[0]->test_degree_id;
		$data['branch_id'] = $test_data[0]->test_branch_id ;
		$data['test_year'] = $test_data[0]->test_year ;
		
		
		$data['college_id'] = explode(',',$data['college_id']);
		$data['degree_id'] = explode(',',$data['degree_id']);
		$data['branch_id'] = explode(',',$data['branch_id']);
		$data['test_year'] = explode(',',$data['test_year']);
		
		$other_college = count($data['college_id']);
        
        $selected_degree_details['college_list'] = \DB::table('institution_master')->whereIn('id',$data['college_id'])->orderBy('name', 'ASC')->select('name', 'id','university_id')->get();
		
		
        $university_id_tmp = \DB::table('institution_master')->whereIn('id',$data['college_id'])->distinct()->lists('university_id');
		 
		$selected_degree_details['university_list'] = \DB::table('university_master')->whereIn('id',$university_id_tmp)->orderBy('name', 'ASC')->lists('name', 'id');
		
        $selected_degree_details['degree_list'] = \DB::table('degree_subtype')->whereIn('id',$data['degree_id'])->orderBy('name', 'ASC')->lists('name', 'id');

        $selected_degree_details['branch_list'] = \DB::table('course_master')->whereIn('id',$data['branch_id'])->orderBy('name', 'ASC')->select('name', 'id','degree_subtype_id')->get();

        foreach ($data['other_degree'] as $odkey => $odvalue) {

            if($odvalue == 20){
                $degree['ug']= \DB::table('degree_subtype')->where('degree_type_id',20)->orderBy('name', 'ASC')->lists('name', 'id');
            }
            if($odvalue == 21){
                $degree['pg']= \DB::table('degree_subtype')->where('degree_type_id',21)->orderBy('name', 'ASC')->lists('name', 'id');
            }
            if($odvalue == 26){
                $degree['diploma_branch']= \DB::table('course_master')->where('degree_subtype_id',30)->orderBy('name', 'ASC')->lists('name', 'id');
            }
            if($odvalue == 1){
                $degree['hsc'] = true;
            }    
        
        }


            return response()->json(['data'=>$data,'selected_degree_details'=>$selected_degree_details,'degree'=>$degree,'languge_details'=>$languge_details,'university_details'=>$university_details], 200);
       
        }


        public function submit_signup(Request $request)

        {
            
      $data = $request->json('post');
    
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        /* \DB::select('CALL flush_users()'); */

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
          //return response()->json(['student_details'=>$data,'diploma_details'=>$diploma_details,'ug_details'=>$ug_details,'pg_details'=>$pg_details], 200);
        
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
                "reponseMessage"    => "Thank you ! <br><br> Your Student profile has been successfully registered.<br><br> please check your email for more details.",
                "responseType"      => "success"
            ], 200);

      }











    }


    