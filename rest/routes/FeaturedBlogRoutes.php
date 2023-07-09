<?php

/**
 * @OA\Get(path="/featuredblogs", tags={"Featured blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Get featured blogs with writer data",
 *     @OA\Response(response="200", description="List of featured blogs with writer data")
 * )
 */
Flight::route("GET /featuredblogs", function (){
    Flight::json(Flight::featuredService()->get_featured_blogs_with_user());
});




/**
 * @OA\Post(path="/featuredblog", tags={"Featured blogs"}, security={{"ApiKeyAuth": {}}},
 * @OA\RequestBody(required=true, description="ID of blog to be featured",
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(required={"blog_id"},
 *                 @OA\Property(property="blog_id", type="integer", example="10"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Blog added to featured"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route("POST /featuredblog", function(){
    $data = Flight::request()->data->getData();
    $response = Flight::featuredService()->add($data);
    Flight::json(['message' => 'featured blog added', 'Data: ' => $response]);
});




/**
 * @OA\Delete(path="/featuredblog/{id}", tags={"Featured blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Remove blog from featured",
 *     @OA\Parameter(in="path", name="id", example=10, description="Blog ID", required=true),
 *     @OA\Response(response="200", description="Removed blog from featured")
 * )
 */
Flight::route("DELETE /featuredblog/@id", function ($id){
    Flight::featuredService()->removefromfeatured($id);
    Flight::json(['message'=>'Blog removed from featured.']);
});