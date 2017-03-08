<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {


    /**
     * The database table used by the model.
     *
     * @var string 
     */
    protected $table = 'company_master';

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
}
