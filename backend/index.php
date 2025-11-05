<?php
require 'vendor/autoload.php'; //run autoloader


require_once __DIR__ . '/services/UserService.php';
Flight::register('userService', 'UserService');


require_once __DIR__ . '/routes/UserRoutes.php';


Flight::start();  //start FlightPHP
?>
