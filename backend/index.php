<?php
require 'vendor/autoload.php'; //run autoloader


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


require_once __DIR__ . '/services/UserService.php';
Flight::register('userService', 'UserService');

require_once __DIR__ . '/services/ListingService.php';
Flight::register('listingService', 'ListingService');

require_once __DIR__ . '/services/FavoritesService.php';
Flight::register('favoriteService', 'FavoritesService');

require_once __DIR__ . '/services/MessageService.php';
Flight::register('messageService', 'MessageService');

require_once __DIR__ . '/services/ImageService.php';
Flight::register('imageService', 'ImageService');

require_once __DIR__ . '/services/AuthService.php';
Flight::register('authService', 'AuthService');


require "middleware/AuthMiddleware.php";
Flight::register('authMiddleware', "AuthMiddleware");


Flight::route('/*', function () {
    if (
        strpos(Flight::request()->url, '/auth/login') === 0 ||
        strpos(Flight::request()->url, '/auth/register') === 0
    ) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if (Flight::authMiddleware()->verifyToken($token))
                return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});


require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/ListingRoutes.php';
require_once __DIR__ . '/routes/FavoritesRoutes.php';
require_once __DIR__ . '/routes/MessageRoutes.php';
require_once __DIR__ . '/routes/ImageRoutes.php';
require_once __DIR__ . '/routes/AuthRoutes.php';


Flight::start();  //start FlightPHP
?>