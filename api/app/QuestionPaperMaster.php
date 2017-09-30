<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionPaperMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "qp_id";


	public static function saveall($data)
		{
			$a =   QuestionPaperMaster::create($data);

			return $a->qp_id;	

	    }


public static function save_return_data($id)
{

return QuestionPaperMaster::where('qp_id',$id)->get();


}
















}
