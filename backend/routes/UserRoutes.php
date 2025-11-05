<?php

Flight::route('GET /user/@id', function($id){
   Flight::json(Flight::userService()->getById($id));
});

?>