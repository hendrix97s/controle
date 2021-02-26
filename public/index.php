<?php

use App\Controller\HomeController;

include_once __DIR__."/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

if($_ENV['DEBUG'] == 'true'){
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors',1);
}
if(isset($_SERVER['REDIRECT_URL'])){

    switch (($_SERVER['REDIRECT_URL'])) {
        case '/home':
            include_once "../view/home.php";
            break;
        default:
            echo "error: 404 - not found";
            break;
    } 
}else{

}
