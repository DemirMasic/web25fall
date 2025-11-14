<?php

//GET
Flight::route('GET /brand', function(){
   $brand = Flight::request()->query['brand'] ?? null;
   Flight::json(Flight::listingService()->getByBrand($brand));
});
Flight::route('GET /brandmodel', function(){
   $brand = Flight::request()->query['brand'] ?? null;
   $model = Flight::request()->query['model'] ?? null;
   Flight::json(Flight::listingService()->getByBrandAndModel($brand, $model));
});

//POST
Flight::route('POST /add_listing', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::listingService()->create($data));
});

//PUT
Flight::route('PUT /update_listing/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::listingService()->update($id, $data));
});
?>

