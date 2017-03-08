<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegeMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "college_id";
		protected $table = "college_master";

}
