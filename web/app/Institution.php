<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model {

/**
     * The database table used by the model.
     *
     * @var string 
     */
    protected $table = 'institution';

    /**
     * The attributes that are mass assignable.
     * @var array 
     */
    protected $fillable = [ ];
    
    /**
     * DateTime constructs automatically
     * @var type 
     */
    public $timestamps = false;
}
