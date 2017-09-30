<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TestMaster;

class TestMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "test_id";
		protected $table = "test_masters";


	

public static function getBatchInstance($data)
{

 	$users = \DB::select(sprintf('SELECT tm.test_id,tm.title,tm.started_on,tm.ended_on,tm.created_on,tm.status,
(SELECT COUNT(*) FROM `student_test_login_masters` AS stlm WHERE stlm.test_id = tm.test_id ) AS attended,
(SELECT COUNT(*) FROM `student_test_login_masters` AS stlm WHERE stlm.test_id = tm.test_id AND stlm.status = 1 ) AS active,
(SELECT COUNT(*) FROM `student_test_login_masters` AS stlm WHERE stlm.test_id = tm.test_id AND stlm.status = 2 ) AS finished,
(SELECT COUNT(*) FROM `test_student_feedback_masters` AS fb WHERE fb.test_id = tm.test_id ) AS feedback
FROM `test_masters` AS tm WHERE tm.batch_id = "%d" AND tm.college_id = "%d"',$data[0],$data[1]));

	return $users;
}














}
