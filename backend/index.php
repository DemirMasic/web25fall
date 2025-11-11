<?php
require 'vendor/autoload.php'; //run autoloader


require_once __DIR__ . '/services/UserService.php';
Flight::register('userService', 'UserService');


require_once __DIR__ . '/routes/UserRoutes.php';

require_once __DIR__ . '/services/ListingService.php';
Flight::register('listingService', 'ListingService');


require_once __DIR__ . '/routes/ListingRoutes.php';


Flight::start();  //start FlightPHP
?>
