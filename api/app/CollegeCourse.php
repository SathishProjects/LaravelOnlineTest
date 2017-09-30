<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegeCourse extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "id";
		protected $table = "college_course_master";


}
?>