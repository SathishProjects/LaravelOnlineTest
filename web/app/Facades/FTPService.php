<?php
/**
 * Created by PhpStorm.
 * User: Rubakeerthana
 * Date: 30-09-2015
 * Time: 14:14
 */
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FTPService extends Facade {

    protected static function getFacadeAccessor() {
        return 'FTPService';
    }
}