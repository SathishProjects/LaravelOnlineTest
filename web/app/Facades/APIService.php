<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class APIService extends Facade {
    
    protected static function getFacadeAccessor() {
        return 'APIService';
    }
}
