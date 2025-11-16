<?php

// GET


Flight::route('GET /message/@id', function($id){
   Flight::json(Flight::messageService()->getById($id));
});


Flight::route('GET /messages', function(){
   Flight::json(Flight::messageService()->getAll());
});


Flight::route('GET /messages/listing/@listing_id', function($listing_id){
   Flight::json(Flight::messageService()->getByListing($listing_id));
});


Flight::route('GET /messages/listing/@listing_id/latest', function($listing_id){
   Flight::json(Flight::messageService()->getLatestByListing($listing_id));
});


Flight::route('GET /messages/listing/@listing_id/user/@user_id', function($listing_id, $user_id){
   Flight::json(Flight::messageService()->getConversation($listing_id, $user_id));
});


// POST (create/insert)

Flight::route('POST /add_message', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::messageService()->create($data));
});

Flight::route('PUT /update_message/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::messageService()->update($id, $data));
});


// DELETE

Flight::route('DELETE /delete_message/@id', function($id){
   Flight::json(Flight::messageService()->delete($id));
});

?>
