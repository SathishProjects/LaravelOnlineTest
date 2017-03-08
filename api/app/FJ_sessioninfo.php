<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FJ_sessioninfo extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "session_id";
		protected $table = "fj_sessioninfo";

}
