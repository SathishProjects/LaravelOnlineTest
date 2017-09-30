<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionPaperQuestionsMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "qpq_id";


public static function saveall($data)
		{
			$a =   QuestionPaperQuestionsMaster::create($data);

			return $a->qpq_id;	

	    }

	
public static function get_section_finished_questions($id)
{

return QuestionPaperQuestionsMaster::where('qp_id',$id)->get(['qp_id','qpq_id','section_id','qpq_order_id','status']);


}

public static function get_current_question_details($id1,$id2,$id3)
{

$temp['question'] = QuestionPaperQuestionsMaster::where('qp_id',$id1)->where('section_order_id',$id2)->where('qpq_order_id',$id3)->get(['qpq_id','question_text','question_hint','question_type','question_image','answer_type','answer_option_type','marks']);

$temp['option']   =  QuestionPaperQuestionAnswersMaster::where('qp_id',$id1)->where('section_order_id',$id2)->where('qpq_order_id',$id3)->get(['qpqa_id','answer_text','answer_image','is_correct']);

return $temp;

}

public static function get_all_question_details($id1)
{

 $question_details =  QuestionPaperQuestionsMaster::where('qp_id','=',$id1)->get();    

            foreach ($question_details as $key1 => $value1) {
                
                $question_details[$key1]['subject_id'] = $question_details[$key1]['subject_id'];
                $question_details[$key1]['subject_id']   =  SubjectMaster::where('subject_id',$question_details[$key1]['subject_id'])->pluck('name');
            }

            return $question_details;

}
















}
