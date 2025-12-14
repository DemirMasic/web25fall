<?php
require_once __DIR__ . '/../data/roles.php';
// =========================
//          GET
// =========================

/**
 * @OA\Get(
 *     path="/brand",
 *     tags={"listings"},
 *     summary="Get listings by brand",
 *     @OA\Parameter(
 *         name="brand",
 *         in="query",
 *         required=false,
 *         description="Brand of the vehicle",
 *         @OA\Schema(type="string", example="Audi")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Listings filtered by brand"
 *     )
 * )
 */
Flight::route('GET /brand', function(){
   $brand = Flight::request()->query['brand'] ?? null;
   Flight::json(Flight::listingService()->getByBrand($brand));
});

/**
 * @OA\Get(
 *     path="/brandmodel",
 *     tags={"listings"},
 *     summary="Get listings by brand and model",
 *     @OA\Parameter(
 *         name="brand",
 *         in="query",
 *         required=false,
 *         description="Brand of the vehicle",
 *         @OA\Schema(type="string", example="BMW")
 *     ),
 *     @OA\Parameter(
 *         name="model",
 *         in="query",
 *         required=false,
 *         description="Model of the vehicle",
 *         @OA\Schema(type="string", example="X5")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Listings filtered by brand and model"
 *     )
 * )
 */
Flight::route('GET /brandmodel', function(){
   $brand = Flight::request()->query['brand'] ?? null;
   $model = Flight::request()->query['model'] ?? null;
   Flight::json(Flight::listingService()->getByBrandAndModel($brand, $model));
});


// =========================
//          POST
// =========================

/**
 * @OA\Post(
 *     path="/add_listing",
 *     tags={"listings"},
 *     summary="Create a new listing",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={
 *                 "user_id","brand","model",
 *                 "year","mileage","power","price",
 *                 "description","gearbox","fuel","drivetrain"
 *             },
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="brand", type="string", example="Audi"),
 *             @OA\Property(property="model", type="string", example="A3"),
 *             @OA\Property(property="year", type="integer", example=2012),
 *             @OA\Property(property="mileage", type="integer", example=160000),
 *             @OA\Property(property="power", type="integer", example=110, description="Engine power (HP)"),
 *             @OA\Property(property="price", type="number", example=12000),
 *             @OA\Property(property="description", type="string", example="Odlično stanje, više informacija na 061 123 456"),
 *             @OA\Property(property="gearbox", type="string", example="Manual", enum={"Manual","Automatic"}),
 *             @OA\Property(property="fuel", type="string", example="Diesel", enum={"Diesel","Gasoline"}),
 *             @OA\Property(property="drivetrain", type="string", example="Rear-wheel drive", enum={"Front-wheel drive","Rear-wheel drive","All-wheel drive"})
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Listing successfully created"
 *     )
 * )
 */
Flight::route('POST /add_listing', function(){
   $user = Flight::get('user');
   Flight::authMiddleware()->authorizeRole(Roles::USER);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::listingService()->create($data));
});


// =========================
//          PUT
// =========================

/**
 * @OA\Put(
 *     path="/update_listing/{id}",
 *     tags={"listings"},
 *     summary="Update an existing listing (all fields required)",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Listing ID",
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={
 *                 "user_id","brand","model",
 *                 "year","mileage","power","price",
 *                 "description","gearbox","fuel","drivetrain"
 *             },
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="brand", type="string", example="Audi"),
 *             @OA\Property(property="model", type="string", example="Q5"),
 *             @OA\Property(property="year", type="integer", example=2018),
 *             @OA\Property(property="mileage", type="integer", example=90000),
 *             @OA\Property(property="power", type="integer", example=200),
 *             @OA\Property(property="price", type="number", example=40000),
 *             @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet"),
 *             @OA\Property(property="gearbox", type="string", example="Automatic", enum={"Manual","Automatic"}),
 *             @OA\Property(property="fuel", type="string", example="Gasoline", enum={"Diesel","Gasoline"}),
 *             @OA\Property(property="drivetrain", type="string", example="All-wheel drive", enum={"Front-wheel drive","Rear-wheel drive","All-wheel drive"})
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Listing updated successfully"
 *     )
 * )
 */
Flight::route('PUT /update_listing/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::listingService()->update($id, $data));
});


// =========================
//        DELETE
// =========================

/**
 * @OA\Delete(
 *     path="/delete_listing/{id}",
 *     tags={"listings"},
 *     summary="Delete a listing by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Listing ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Listing deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /delete_listing/@id', function($id){
   Flight::json(Flight::listingService()->delete($id));
});

?>
