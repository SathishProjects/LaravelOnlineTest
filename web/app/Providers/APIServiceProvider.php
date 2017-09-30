<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services;

class APIServiceProvider extends ServiceProvider {

    protected $defer = true;
    
    public function __construct($app) {
        parent::__construct($app);
    }
    
    public function boot(){ }

    public function register() {
        $this->app->bind('APIService', function($app){
            return new Services\APIService();
        });
    }
    
    public function provides()
    {
        return ['APIService'];
    }
}