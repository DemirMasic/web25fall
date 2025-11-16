<?php

// GET


Flight::route('GET /image/@id', function($id){
   Flight::json(Flight::imageService()->getById($id));
});


Flight::route('GET /images', function(){
   Flight::json(Flight::imageService()->getAll());
});


Flight::route('GET /images/listing/@listing_id', function($listing_id){
   Flight::json(Flight::imageService()->getByListingId($listing_id));
});


// POST (create/insert)

Flight::route('POST /add_image', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::imageService()->create($data));
});


// PUT (update)

Flight::route('PUT /update_image/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::imageService()->update($id, $data));
});


// DELETE

Flight::route('DELETE /delete_image/@id', function($id){
   Flight::json(Flight::imageService()->delete($id));
});

?>
