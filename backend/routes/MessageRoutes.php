<?php

// ======================
//        GET
// ======================

/**
 * @OA\Get(
 *     path="/message/{id}",
 *     tags={"messages"},
 *     summary="Get a message by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Message ID",
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the message with the given ID"
 *     )
 * )
 */
Flight::route('GET /message/@id', function($id){
   Flight::json(Flight::messageService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/messages",
 *     tags={"messages"},
 *     summary="Get all messages",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all messages"
 *     )
 * )
 */
Flight::route('GET /messages', function(){
   Flight::json(Flight::messageService()->getAll());
});

/**
 * @OA\Get(
 *     path="/messages/listing/{listing_id}",
 *     tags={"messages"},
 *     summary="Get all messages for a listing",
 *     @OA\Parameter(
 *         name="listing_id",
 *         in="path",
 *         required=true,
 *         description="Listing ID",
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns all messages for the specified listing"
 *     )
 * )
 */
Flight::route('GET /messages/listing/@listing_id', function($listing_id){
   Flight::json(Flight::messageService()->getByListing($listing_id));
});

/**
 * @OA\Get(
 *     path="/messages/listing/{listing_id}/latest",
 *     tags={"messages"},
 *     summary="Get the latest message for a listing",
 *     @OA\Parameter(
 *         name="listing_id",
 *         in="path",
 *         required=true,
 *         description="Listing ID",
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the latest message for the listing"
 *     )
 * )
 */
Flight::route('GET /messages/listing/@listing_id/latest', function($listing_id){
   Flight::json(Flight::messageService()->getLatestByListing($listing_id));
});

/**
 * @OA\Get(
 *     path="/messages/listing/{listing_id}/user/{user_id}",
 *     tags={"messages"},
 *     summary="Get conversation between a user and a listing",
 *     @OA\Parameter(
 *         name="listing_id",
 *         in="path",
 *         required=true,
 *         description="Listing ID",
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns all messages between user and listing"
 *     )
 * )
 */
Flight::route('GET /messages/listing/@listing_id/user/@user_id', function($listing_id, $user_id){
   Flight::json(Flight::messageService()->getConversation($listing_id, $user_id));
});


// ======================
//        POST
// ======================

/**
 * @OA\Post(
 *     path="/add_message",
 *     tags={"messages"},
 *     summary="Create a new message",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"listing_id", "user_id", "content"},
 *             @OA\Property(property="listing_id", type="integer", example=12),
 *             @OA\Property(property="user_id", type="integer", example=3),
 *             @OA\Property(property="content", type="string", example="Is this car still available?")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Message successfully created"
 *     )
 * )
 */
Flight::route('POST /add_message', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::messageService()->create($data));
});


// ======================
//        PUT
// ======================

/**
 * @OA\Put(
 *     path="/update_message/{id}",
 *     tags={"messages"},
 *     summary="Update an existing message",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Message ID",
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="content", type="string", example="Updated message text")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Message updated successfully"
 *     )
 * )
 */
Flight::route('PUT /update_message/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::messageService()->update($id, $data));
});


// ======================
//       DELETE
// ======================

/**
 * @OA\Delete(
 *     path="/delete_message/{id}",
 *     tags={"messages"},
 *     summary="Delete a message by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Message ID",
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Message deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /delete_message/@id', function($id){
   Flight::json(Flight::messageService()->delete($id));
});

?>
