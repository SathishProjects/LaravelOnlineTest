<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "student_id";
		protected $table = "candidate_master";



}
