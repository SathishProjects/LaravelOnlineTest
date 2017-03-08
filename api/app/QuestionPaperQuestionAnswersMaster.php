<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionPaperQuestionAnswersMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "qpqa_id";


public static function saveall($data)
		{
			$a =   QuestionPaperQuestionAnswersMaster::create($data);

			return $a->qpqa_id;	

	    }


















}
