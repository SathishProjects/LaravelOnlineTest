<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {


    /**
     * The database table used by the model.
     *
     * @var string 
     */
    protected $table = 'job_post';

    /**
     * The attributes that are mass assignable.
     * @var array 
     */
    protected $fillable = [];
    
    /**
     * DateTime constructs automatically
     * @var type 
     */
    public $timestamps = false;
	
    public function degreeType() {
        return $this->belongsTo('App\DegreeType');
    }
    
    public function candidates() {
        return $this->belongsTo('App\Candidates');
    }
}
