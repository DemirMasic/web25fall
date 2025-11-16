<?php

// GET

Flight::route('GET /user/@id', function($id){
   Flight::json(Flight::userService()->getById($id));
});

Flight::route('GET /users', function(){
   Flight::json(Flight::userService()->getAll());
});

Flight::route('GET /user/email/@email', function($email){
   Flight::json(Flight::userService()->getByEmail($email));
});

Flight::route('GET /user/username/@username', function($username){
   Flight::json(Flight::userService()->getByUsername($username));
});
// POST (create/insert)

Flight::route('POST /add_user', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->create($data));
});

// PUT (update)

Flight::route('PUT /update_user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->update($id, $data));
});

// DELETE

Flight::route('DELETE /delete_user/@id', function($id){
   Flight::json(Flight::userService()->delete($id));
});

?>