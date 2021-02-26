<?php

namespace App\Helpers;

class Debug
{
    public static function show($message):void{
        if($_ENV['DEBUG'] == 'true'){
            print_r($message);
        }
    }
}
