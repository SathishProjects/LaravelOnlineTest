<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTestLoginMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "student_test_login_id";

	public static function get_attended_students_list($data)
		{
			return StudentTestLoginMaster::where('test_id',$data)->lists('student_id');
	    }
	
	















}
