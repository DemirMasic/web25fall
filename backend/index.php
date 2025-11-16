<?php
require 'vendor/autoload.php'; //run autoloader


require_once __DIR__ . '/services/UserService.php';
Flight::register('userService', 'UserService');


require_once __DIR__ . '/routes/UserRoutes.php';

require_once __DIR__ . '/services/ListingService.php';
Flight::register('listingService', 'ListingService');


require_once __DIR__ . '/routes/ListingRoutes.php';

require_once __DIR__ . '/services/FavoritesService.php';
Flight::register('favoriteService', 'FavoritesService');

require_once __DIR__ . '/routes/FavoritesRoutes.php';

require_once __DIR__ . '/services/MessageService.php';
Flight::register('messageService', 'MessageService');

require_once __DIR__ . '/routes/MessageService.php';


Flight::start();  //start FlightPHP
?>
