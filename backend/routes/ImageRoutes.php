<?php

// =========================
//          GET
// =========================

/**
 * @OA\Get(
 *     path="/image/{id}",
 *     tags={"images"},
 *     summary="Get image by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Image ID",
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the image with the given ID"
 *     )
 * )
 */
Flight::route('GET /image/@id', function($id){
   Flight::json(Flight::imageService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/images",
 *     tags={"images"},
 *     summary="Get all images",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all images in the database"
 *     )
 * )
 */
Flight::route('GET /images', function(){
   Flight::json(Flight::imageService()->getAll());
});

/**
 * @OA\Get(
 *     path="/images/listing/{listing_id}",
 *     tags={"images"},
 *     summary="Get all images for a specific listing",
 *     @OA\Parameter(
 *         name="listing_id",
 *         in="path",
 *         required=true,
 *         description="Listing ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Array of images for the given listing"
 *     )
 * )
 */
Flight::route('GET /images/listing/@listing_id', function($listing_id){
   Flight::json(Flight::imageService()->getByListingId($listing_id));
});


// =========================
//          POST
// =========================

/**
 * @OA\Post(
 *     path="/add_image",
 *     tags={"images"},
 *     summary="Upload/add an image for a listing",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"listing_id", "image_url"},
 *             @OA\Property(property="listing_id", type="integer", example=3),
 *             @OA\Property(property="image_url", type="string", example="https://yourdomain.com/uploads/cars/audi-a3-1.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Image successfully added"
 *     )
 * )
 */
Flight::route('POST /add_image', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::imageService()->create($data));
});


// =========================
//          PUT
// =========================

/**
 * @OA\Put(
 *     path="/update_image/{id}",
 *     tags={"images"},
 *     summary="Update image information",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Image ID",
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="listing_id", type="integer", example=3),
 *             @OA\Property(property="image_url", type="string", example="https://yourdomain.com/uploads/new-image-name.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Image successfully updated"
 *     )
 * )
 */
Flight::route('PUT /update_image/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::imageService()->update($id, $data));
});


// =========================
//         DELETE
// =========================

/**
 * @OA\Delete(
 *     path="/delete_image/{id}",
 *     tags={"images"},
 *     summary="Delete an image by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Image ID",
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Image successfully deleted"
 *     )
 * )
 */
Flight::route('DELETE /delete_image/@id', function($id){
   Flight::json(Flight::imageService()->delete($id));
});

?>
