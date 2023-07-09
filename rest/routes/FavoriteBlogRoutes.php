<?php

/**
 * @OA\Get(path="/favoriteblogs/{userid}", tags={"Favorite blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return favorite blogs by user",
 *     @OA\Parameter(in="path", name="id", example=27, description="User ID", required=true),
 *     @OA\Response(response="200", description="Fetch blog by ID")
 * )
 */
Flight::route("GET /favoriteblogs/@userid", function ($userId){
    Flight::json(Flight::favoriteService()->get_favorites_by_user($userId));
});

Flight::route("POST /favoriteblog", function(){
    $data = Flight::request()->data->getData();
    $response = Flight::favoriteService()->add($data);
    Flight::json(['message' => 'favorite added', 'Data: ' => $response]);
});

Flight::route("DELETE /favoriteblog", function (){
    $data = Flight::request()->data->getData();
    Flight::favoriteService()->removeFavorite($data);
    Flight::json(['message'=>'Blog successfully deleted.']);
});