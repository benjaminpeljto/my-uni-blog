<?php

/**
 * @OA\Get(path="/favoriteblogs/{userid}", tags={"Favorite blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return favorite blogs by user",
 *     @OA\Parameter(in="path", name="userid", example=27, description="User ID", required=true),
 *     @OA\Response(response="200", description="Fetch blog by ID")
 * )
 */
Flight::route("GET /favoriteblogs/@userid", function ($userId){
    Flight::json(Flight::favoriteService()->get_favorites_by_user($userId));
});




/**
 * @OA\Post(path="/favoriteblog", tags={"Favorite blogs"}, security={{"ApiKeyAuth": {}}},
     * @OA\RequestBody(required=true, description="New blog details",
     *         @OA\MediaType(mediaType="application/json",
     *             @OA\Schema(required={"blog_id","user_id"},
     *                 @OA\Property(property="blog_id", type="integer", example="10"),
     *                 @OA\Property(property="user_id", type="integer", example="27"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Favorite blog added"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error"
     *     )
     * )
 */
Flight::route("POST /favoriteblog", function(){
    $data = Flight::request()->data->getData();
    $response = Flight::favoriteService()->add($data);
    Flight::json(['message' => 'favorite added', 'Data: ' => $response]);
});




/**
 * @OA\Delete(path="/favoriteblog", tags={"Favorite blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Delete favorite blog of user",
 *     @OA\RequestBody(required=true, description="Blog ID and user ID",
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(required={"blog_id","user_id"},
 *                 @OA\Property(property="blog_id", type="integer", example=10),
 *                 @OA\Property(property="user_id", type="integer", example=27),
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="Deleted favorite blog of user")
 * )
 */
Flight::route("DELETE /favoriteblog", function (){
    $data = Flight::request()->data->getData();
    Flight::favoriteService()->removeFavorite($data);
    Flight::json(['message'=>'Blog successfully deleted.']);
});