<?php

// =========================
//          GET
// =========================

/**
 * @OA\Get(
 *     path="/favorites",
 *     tags={"favorites"},
 *     summary="Get all favorites",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all favorite records (user_id + listing_id pairs)"
 *     )
 * )
 */
Flight::route('GET /favorites', function(){
   Flight::json(Flight::favoriteService()->getAll());
});

/**
 * @OA\Get(
 *     path="/favorites/user/{user_id}",
 *     tags={"favorites"},
 *     summary="Get all favorites for a specific user",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Array of favorites for the specified user"
 *     )
 * )
 */
Flight::route('GET /favorites/user/@user_id', function($user_id){
   Flight::json(Flight::favoriteService()->getByUserId($user_id));
});


// =========================
//          POST
// =========================

/**
 * @OA\Post(
 *     path="/add_favorite",
 *     tags={"favorites"},
 *     summary="Add a listing to user's favorites",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id","listing_id"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="listing_id", type="integer", example=3)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Favorite successfully added"
 *     )
 * )
 */
Flight::route('POST /add_favorite', function(){
   $data = Flight::request()->data->getData();
   $user_id    = $data['user_id'] ?? null;
   $listing_id = $data['listing_id'] ?? null;
   Flight::json(Flight::favoriteService()->addFavorite($user_id, $listing_id));
});


// =========================
//         DELETE
// =========================

/**
 * @OA\Delete(
 *     path="/delete_favorite/{user_id}/{listing_id}",
 *     tags={"favorites"},
 *     summary="Remove a listing from user's favorites",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="listing_id",
 *         in="path",
 *         required=true,
 *         description="Listing ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Favorite successfully deleted"
 *     )
 * )
 */
Flight::route('DELETE /delete_favorite/@user_id/@listing_id', function($user_id, $listing_id){
   Flight::json(Flight::favoriteService()->deleteFavorite($user_id, $listing_id));
});

?>
