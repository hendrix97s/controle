<?php

include_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

if ($_ENV['DEBUG'] == 'true') {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
}


include_once "../routes/web.php";