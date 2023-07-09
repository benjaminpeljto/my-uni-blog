<?php

/**
 * @OA\Get(path="/blogs", tags={"Blogs"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all blogs. ",
 *         @OA\Response( response=200, description="List of blogs")
 * )
 */
Flight::route("GET /blogs", function () {
    Flight::json(Flight::blogService()->get_all());
});




/**
 * @OA\Get(path="/blogswithuser", tags={"Blogs"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all blogs with writer data.",
 *         @OA\Response( response=200, description="List of blogs with writer data")
 * )
 */
Flight::route("GET /blogswithuser", function () {
    Flight::json(Flight::blogService()->get_blogs_with_user());
});




/**
 * @OA\Get(path="/blogwithuser/{id}", tags={"Blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return blog with writer data by blog ID",
 *     @OA\Parameter(in="path", name="id", example=10, description="Blog ID"),
 *     @OA\Response(response="200", description="Fetch blog by user ID")
 * )
 */
Flight::route("GET /blogwithuser/@id", function ($id){
    Flight::json(Flight::blogService()->get_blog_with_user_by_id($id));
});




/**
 * @OA\Get(path="/blog/{id}", tags={"Blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return blog by ID",
 *     @OA\Parameter(in="path", name="id", example=10, description="Blog ID", required=true),
 *     @OA\Response(response="200", description="Fetch blog by ID")
 * )
 */
Flight::route("GET /blog/@id", function ($id) {
    Flight::json(Flight::blogService()->get_by_id($id));
});




/**
 * @OA\Get(path="/blogsById", tags={"Blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return blog by ID",
 *     @OA\Parameter(in="query", name="id", example=10, description="Blog ID", required=true),
 *     @OA\Response(response="200", description="Fetch blog by ID")
 * )
 */
Flight::route("GET /blogsById", function () {
    Flight::json(Flight::blogService()->get_by_id(Flight::request()->query['id']));
});




/**
 * @OA\Delete(path="/blogs/{id}", tags={"Blogs"}, security={{"ApiKeyAuth": {}}},
 *     summary="Delete blog",
 *     @OA\Parameter(in="path", name="id", example=3, description="Blog ID", required=true),
 *     @OA\Response(response="200", description="Delete blog by ID")
 * )
 */
Flight::route("DELETE /blogs/@id", function ($id) {
    Flight::blogService()->delete($id);
    Flight::json(['message' => 'blog by id ' . $id . ' has been deleted.']);
});




/**
 * @OA\Post(path="/blogs", tags={"Blogs"}, description="Add a new blog", security={{"ApiKeyAuth": {}}},
 *     @OA\RequestBody(required=true, description="New blog details",
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(required={"id","title", "content", "create_time", "user_id", "category_id"},
 *                 @OA\Property(property="id", type="integer", example="3"),
 *                 @OA\Property(property="title", type="string", example="Car guy"),
 *                 @OA\Property(property="content", type="string", example="Cars have become an integral part of modern life. They are a symbol of freedom and provide convenience in transportation. Cars come in different shapes, sizes, and types, and each has its own unique features and benefits. From sports cars that offer speed and agility to family SUVs that provide space and comfort, there's a car for everyone. Cars have also evolved over time, with advanced technology and safety features that make driving safer and more enjoyable. While cars have their advantages, they also have their downsides, such as environmental impact and traffic congestion. Despite this, cars remain an essential part of our daily lives and will continue to shape the way we live and work."),
 *                 @OA\Property(property="create_time", type="string", format="date-time", example="2023-02-19 18:30:45"),
 *                 @OA\Property(property="user_id", type="integer", example=18),
 *                 @OA\Property(property="category_id", type="integer", example=4)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Blog has been successfully added"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route("POST /blogs", function () {
    $data = Flight::request()->data->getData();
    $response = Flight::blogService()->add($data);
    Flight::json(['message' => 'blog added successfully.', 'Data: ' => $response]);

});




/**
 * @OA\Put(path="/blogs/{id}", tags={"Blogs"}, description="Update a blog", security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=16, description="ID of the blog to update", required=true),
 *     @OA\RequestBody(required=true, description="Updated blog details",
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="title", type="string", example="Updated Title"),
 *                 @OA\Property(property="content", type="string", example="Updated content..."),
 *                 @OA\Property(property="create_time", type="string", format="date-time", example="2023-07-09 10:30:00"),
 *                 @OA\Property(property="user_id", type="integer", example=28),
 *                 @OA\Property(property="category_id", type="integer", example=4)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Blog has been successfully updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Blog not found"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route("PUT /blogs/@id", function ($id) {
    $data = Flight::request()->data->getData();
    $response = Flight::blogService()->update($data, $id);
    Flight::json(['message' => 'Updated blog with new data.', 'Data' => $response]);
});
