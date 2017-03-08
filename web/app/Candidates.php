<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidates extends Model {


    /**
     * The database table used by the model.
     *
     * @var string 
     */
    protected $table = 'candidates';

    /**
     * The attributes that are mass assignable.
     * @var array 
     */
    protected $fillable = [ 'first_name','email','mobile','date_of_birth','gender','SSLC_course','SSLC_percentage','SSLC_year_of_completion','HSC_course','HSC_percentage','HSC_year_of_completion','UG_percentage'];
    
    /**
     * DateTime constructs automatically
     * @var type 
     */
    public $timestamps = false;

}
