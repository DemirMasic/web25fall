<?php

Flight::route('GET /brand', function(){
   $brand = Flight::request()->query['brand'] ?? null;
   Flight::json(Flight::listingService()->getByBrand($brand));
});
Flight::route('GET /brandmodel', function(){
   $brand = Flight::request()->query['brand'] ?? null;
   $model = Flight::request()->query['model'] ?? null;
   Flight::json(Flight::listingService()->getByBrandAndModel($brand, $model));
});


?>

