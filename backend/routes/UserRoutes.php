<?php

// GET

/**
 * @OA\Get(
 *     path="/user/{id}",
 *     tags={"users"},
 *     summary="Get user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User with the given ID"
 *     )
 * )
 */
Flight::route('GET /user/@id', function($id){
   Flight::json(Flight::userService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"users"},
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all users"
 *     )
 * )
 */
Flight::route('GET /users', function(){
   Flight::json(Flight::userService()->getAll());
});

/**
 * @OA\Get(
 *     path="/user/email/{email}",
 *     tags={"users"},
 *     summary="Get user by email",
 *     @OA\Parameter(
 *         name="email",
 *         in="path",
 *         required=true,
 *         description="Email of the user",
 *         @OA\Schema(type="string", format="email", example="user@example.com")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User with the given email"
 *     )
 * )
 */
Flight::route('GET /user/email/@email', function($email){
   Flight::json(Flight::userService()->getByEmail($email));
});

/**
 * @OA\Get(
 *     path="/user/username/{username}",
 *     tags={"users"},
 *     summary="Get user by username",
 *     @OA\Parameter(
 *         name="username",
 *         in="path",
 *         required=true,
 *         description="Username of the user",
 *         @OA\Schema(type="string", example="demir123")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User with the given username"
 *     )
 * )
 */
Flight::route('GET /user/username/@username', function($username){
   Flight::json(Flight::userService()->getByUsername($username));
});

// POST (create/insert)

/**
 * @OA\Post(
 *     path="/add_user",
 *     tags={"users"},
 *     summary="Create a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"username","email","password"},
 *             @OA\Property(property="username", type="string", example="demir123"),
 *             @OA\Property(property="email", type="string", format="email", example="demir@example.com"),
 *             @OA\Property(property="password", type="string", example="secret123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User successfully created"
 *     )
 * )
 */
Flight::route('POST /add_user', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->create($data));
   // postman vraca True kada dodamo korisnika
});

// PUT (update)

/**
 * @OA\Put(
 *     path="/update_user/{id}",
 *     tags={"users"},
 *     summary="Update an existing user",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="username", type="string", example="new_username"),
 *             @OA\Property(property="email", type="string", format="email", example="newmail@example.com"),
 *             @OA\Property(property="password", type="string", example="newSecret123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User successfully updated"
 *     )
 * )
 */
Flight::route('PUT /update_user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->update($id, $data));
});

// DELETE

/**
 * @OA\Delete(
 *     path="/delete_user/{id}",
 *     tags={"users"},
 *     summary="Delete a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User successfully deleted"
 *     )
 * )
 */
Flight::route('DELETE /delete_user/@id', function($id){
   Flight::json(Flight::userService()->delete($id));
});

?>
