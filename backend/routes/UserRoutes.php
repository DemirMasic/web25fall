<?php

Flight::route('GET /user/@id', function($id){
   Flight::json(Flight::userService()->getById($id));
});

Flight::route('GET /users', function(){
   Flight::json(Flight::userService()->getAll());
});

Flight::route('GET /user/email/@email', function($email){
   Flight::json(Flight::userService()->getByEmail($email));
});

?>