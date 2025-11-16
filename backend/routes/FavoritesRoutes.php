<?php

// GET

Flight::route('GET /favorites', function(){
   Flight::json(Flight::favoriteService()->getAll());
});
Flight::route('GET /favorites/user/@user_id', function($user_id){
   Flight::json(Flight::favoriteService()->getByUserId($user_id));
});
// POST (create/insert)
Flight::route('POST /add_favorite', function(){
   $data = Flight::request()->data->getData();
   $user_id    = $data['user_id'] ?? null;
   $listing_id = $data['listing_id'] ?? null;
   Flight::json(Flight::favoriteService()->addFavorite($user_id, $listing_id));
});

// DELETE
Flight::route('DELETE /delete_favorite/@user_id/@listing_id', function($user_id, $listing_id){
   Flight::json(Flight::favoriteService()->deleteFavorite($user_id, $listing_id));
});

?>
