<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TestResponseMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "test_response_id";


	

public static function get_test_report($id)
{

$test_details = TestLoginMaster::where('test_id',$id)->get(['test_id','test_id']);

$qp_details = TestMaster::where('test_id',$test_details[0]->test_id)->get(['is_negative','qp_id']);

$Section_records =  SectionMaster::get_section_details($qp_details[0]->qp_id);

$subject = [];

foreach ($Section_records as $srkey => $srvalue) {
		if(!in_array( $srvalue->section_subject, $subject))
        	$subject[] = $srvalue->section_subject;
        }    

$subjectkey = [];
foreach ($Section_records as $sr1key => $sr1value) {
                    if(!in_array( $sr1value->section_subject, $subjectkey))
                        $subjectkey[$sr1value->section_subject_id] = $sr1value->section_subject;
                } 


$Question_records =  QuestionPaperQuestionsMaster::where('qp_id',$qp_details[0]->qp_id)->get(['qpq_id','qpq_order_id','qp_id','section_id','section_order_id','subject_id','marks',]);

foreach ($Question_records as $qkey => $qvalue) {
          $qvalue->section_subject = SubjectMaster::where('subject_id',$qvalue->subject_id)->pluck('name');
        }        

$question_answer_details = QuestionPaperQuestionAnswersMaster::where('qp_id',$qp_details[0]->qp_id)->where('is_correct',1)->get(['qpq_id','qpqa_id']);

$test_response_details =  TestResponseMaster::where('test_id',$id)->get(['test_id','user_id','student_id','qpq_id','currect_qpqa_id','response_qpqa_id']);

foreach ($test_response_details as $tr3key => $tr3value) {
	foreach ($question_answer_details as $qakey => $qavalue) {
		if( $qavalue->qpq_id == $tr3value->qpq_id)	
			$tr3value->currect_qpqa_id	 =  $qavalue->qpqa_id;
		if( $tr3value->currect_qpqa_id == $tr3value->response_qpqa_id){
			 $tr3value->is_correct = 1;
		}
		else{
			$tr3value->is_correct = 0;
		}
	}

}





	foreach($subject as $skey => $sval){
		
		$section_questions_count = 0;
		foreach($Question_records as $qrkey1 => $qrval1){
			if($qrval1->section_subject == $sval){
				$section_questions_count++;
			}
		}

		$questions_per_subject[] = $section_questions_count;

	}
	

	$student_list=[]; $student_list_details=[];
	foreach ($test_response_details as $trkey => $trvalue) {
		if(!in_array($trvalue->student_id, $student_list))
		$student_list[] =$trvalue->student_id;
	}
	

	foreach ($student_list as $slkey => $slvalue) {
		 

		foreach ($test_response_details as $tr2key => $tr2value) {
			if($tr2value->student_id == $slvalue)
				$student_list_details[$slkey]['attended'][] =$tr2value->qpq_id;
		}
		

		foreach($subject as $skey => $sval){

			$student_list_details[$sval][$slkey]['test_id'] = $test_details[0]->test_id;
		 	$student_list_details[$sval][$slkey]['test_id'] = $test_details[0]->test_login_id;
		 	$student_list_details[$sval][$slkey]['student_id'] = $slvalue;
		 	
		 	foreach($subjectkey as $skkey=>$skvalue)
			{
  				if ($skvalue == $sval) {
  					$student_list_details[$sval][$slkey]['subject_id'] = $skkey;
  				}
			}

			$student_list_details[$sval][$slkey]['total'] = 0;
			$student_list_details[$sval][$slkey]['correct'] = 0;
			$student_list_details[$sval][$slkey]['incorrect'] = 0;	
			$student_list_details[$sval][$slkey]['attended'] = 0;	
			$student_list_details[$sval][$slkey]['not_attended'] = 0;	

			foreach($Question_records as $qrkey2 => $qrval2){

				if($qrval2->section_subject == $sval){
					$student_list_details[$sval][$slkey]['total']++;
				}

				if(in_array($qrval2->qpq_id,$student_list_details[$slkey]['attended']) && $qrval2->section_subject == $sval){

					foreach ($test_response_details as $tr4key => $tr4value) {
						if($tr4value->qpq_id == $qrval2->qpq_id && $tr4value->is_correct == 1 && $tr4value->student_id == $slvalue){
								$student_list_details[$sval][$slkey]['correct']++;
						}
						elseif($tr4value->qpq_id == $qrval2->qpq_id && $tr4value->is_correct == 0 && $tr4value->student_id == $slvalue){
								$student_list_details[$sval][$slkey]['incorrect']++;
						}
					}

					$student_list_details[$sval][$slkey]['attended']++;
				}
				elseif($qrval2->section_subject == $sval){
					$student_list_details[$sval][$slkey]['not_attended']++;
				}
			}
		}

		

		unset($student_list_details[$slkey]['attended']);
	}


return $student_list_details;
}


public static function get_test_report_student($id,$id2)
{


$qp_details = TestMaster::where('test_id',$id)->get(['is_negative','qp_id','number_of_questions']);

$Section_records =  SectionMaster::get_section_details($qp_details[0]->qp_id);

$subject = [];

foreach ($Section_records as $srkey => $srvalue) {
		if(!in_array( $srvalue->section_subject, $subject))
        	$subject[] = $srvalue->section_subject;
        }    

$subjectkey = [];
foreach ($Section_records as $sr1key => $sr1value) {
                    if(!in_array( $sr1value->section_subject, $subjectkey))
                        $subjectkey[$sr1value->section_subject_id] = $sr1value->section_subject;
                } 


$Question_records =  QuestionPaperQuestionsMaster::where('qp_id',$qp_details[0]->qp_id)->get(['qpq_id','qpq_order_id','qp_id','section_id','section_order_id','subject_id','marks',]);

foreach ($Question_records as $qkey => $qvalue) {
          $qvalue->section_subject = SubjectMaster::where('subject_id',$qvalue->subject_id)->pluck('name');
        }        

$question_answer_details = QuestionPaperQuestionAnswersMaster::where('qp_id',$qp_details[0]->qp_id)->where('is_correct',1)->get(['qpq_id','qpqa_id']);

$test_response_details =  TestResponseMaster::where('test_id',$id)->where('student_id',$id2)->get(['test_id','user_id','student_id','qpq_id','currect_qpqa_id','response_qpqa_id']);

foreach ($test_response_details as $tr3key => $tr3value) {
	foreach ($question_answer_details as $qakey => $qavalue) {
		if( $qavalue->qpq_id == $tr3value->qpq_id)	
			$tr3value->currect_qpqa_id	 =  $qavalue->qpqa_id;
		if( $tr3value->currect_qpqa_id == $tr3value->response_qpqa_id){
			 $tr3value->is_correct = 1;
		}
		else{
			$tr3value->is_correct = 0;
		}
	}

}



	foreach($subject as $skey => $sval){
		
		$section_questions_count = 0;
		foreach($Question_records as $qrkey1 => $qrval1){
			if($qrval1->section_subject == $sval){
				$section_questions_count++;
			}
		}

		$questions_per_subject[] = $section_questions_count;

	}

	$student_list=[]; 
	foreach ($test_response_details as $trkey => $trvalue) {
		if(!in_array($trvalue->student_id, $student_list))
		$student_list[] =$trvalue->student_id;
	}

	foreach ($student_list as $slkey => $slvalue) {
		 

		foreach ($test_response_details as $tr2key => $tr2value) {
			if($tr2value->student_id == $slvalue)
				$student_list_details[$slkey]['attended'][] =$tr2value->qpq_id;
		}
		

		foreach($subject as $skey => $sval){

			$student_list_details[$sval][$slkey]['test_id'] = $id;
		 	$student_list_details[$sval][$slkey]['student_id'] = $slvalue;
		 	
		 	foreach($subjectkey as $skkey=>$skvalue)
			{
  				if ($skvalue == $sval) {
  					$student_list_details[$sval][$slkey]['subject_id'] = $skkey;
  				}
			}

			$student_list_details[$sval][$slkey]['total'] = 0;
			$student_list_details[$sval][$slkey]['correct'] = 0;
			$student_list_details[$sval][$slkey]['incorrect'] = 0;	
			$student_list_details[$sval][$slkey]['attended'] = 0;	
			$student_list_details[$sval][$slkey]['not_attended'] = 0;	

			foreach($Question_records as $qrkey2 => $qrval2){

				if($qrval2->section_subject == $sval){
					$student_list_details[$sval][$slkey]['total']++;
				}

				if(in_array($qrval2->qpq_id,$student_list_details[$slkey]['attended']) && $qrval2->section_subject == $sval){

					foreach ($test_response_details as $tr4key => $tr4value) {
						if($tr4value->qpq_id == $qrval2->qpq_id && $tr4value->is_correct == 1 && $tr4value->student_id == $slvalue){
								$student_list_details[$sval][$slkey]['correct']++;
						}
						elseif($tr4value->qpq_id == $qrval2->qpq_id && $tr4value->is_correct == 0 && $tr4value->student_id == $slvalue){
								$student_list_details[$sval][$slkey]['incorrect']++;
						}
					}

					$student_list_details[$sval][$slkey]['attended']++;
				}
				elseif($qrval2->section_subject == $sval){
					$student_list_details[$sval][$slkey]['not_attended']++;
				}
			}
		}

		
		if($student_list_details){
			unset($student_list_details[$slkey]['attended']);
		}
		
	}

		$result = 0;

		if(isset($student_list_details)){
		$tmp1 = array_filter($student_list_details);

		foreach ($tmp1 as $tmkey => $tmvalue) {
			$result = $result + $tmvalue[0]['correct'];
		}
		
		}

		return [$result,$qp_details[0]->number_of_questions];
}











}
