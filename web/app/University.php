<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model {

    /**
     * The database table used by the model.
     *
     * @var string 
     */
    protected $table = 'university';

    /**
     * The attributes that are mass assignable.
     * @var array 
     */
    protected $fillable = [ 'name', 'remarks', 'status'];
    
    /**
     * DateTime constructs automatically
     * @var type 
     */
    public $timestamps = false;

}
