<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GeocoderService extends Facade
{
    protected static function getFacadeAccessor(){
        return 'geocoderProvider';
    }
}