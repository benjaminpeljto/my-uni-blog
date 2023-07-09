<?php

/**
 * @OA\Get(path="/category/{id}", tags={"Categories"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return blogs by category ID",
 *     @OA\Parameter(in="path", name="id", example=4, description="Category ID", required=true),
 *     @OA\Response(response="200", description="Get all blogs by category")
 * )
 */
    Flight::route("GET /category/@id", function ($id){
        Flight::json(Flight::categoryService()->get_blogs_by_category($id));
    });