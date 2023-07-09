<?php

/**
 * @OA\Get(path="/blogs", tags={"blogs"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all blogs. ",
 *         @OA\Response( response=200, description="List of blogs")
 * )
 */
Flight::route("GET /blogs", function () {
    Flight::json(Flight::blogService()->get_all());
});

/**
 * @OA\Get(path="/blogswithuser", tags={"blogs"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all blogs with writer data.",
 *         @OA\Response( response=200, description="List of blogs with writer data")
 * )
 */
Flight::route("GET /blogswithuser", function () {
    Flight::json(Flight::blogService()->get_blogs_with_user());
});

/**
 * @OA\Get(path="/blogswithuser/{id}", tags={"blogs"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="User ID"),
 *     @OA\Response(response="200", description="Fetch blog by user ID")
 * )
 */
Flight::route("GET /blogwithuser/@id", function ($id){
    Flight::json(Flight::blogService()->get_blog_with_user_by_id($id));
});

Flight::route("GET /blog/@id", function ($id) {
    Flight::json(Flight::blogService()->get_by_id($id));
});

Flight::route("GET /blogsById", function () {
    Flight::json(Flight::blogService()->get_by_id(Flight::request()->query['id']));
});

Flight::route("DELETE /blogs/@id", function ($id) {
    Flight::blogService()->delete($id);
    Flight::json(['message' => 'blog by id ' . $id . ' has been deleted.']);
});

Flight::route("POST /blogs", function () {
    $data = Flight::request()->data->getData();
    $response = Flight::blogService()->add($data);
    Flight::json(['message' => 'blog added successfully.', 'Data: ' => $response]);

});

Flight::route("PUT /blogs/@id", function ($id) {
    $data = Flight::request()->data->getData();
    $response = Flight::blogService()->update($data, $id);
    Flight::json(['message' => 'Updated blog with new data.', 'Data' => $response]);
});
