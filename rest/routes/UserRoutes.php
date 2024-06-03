<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

/**
 * @OA\Get(path="/users", tags={"Users"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all users. ",
 *         @OA\Response( response=200, description="List of users")
 * )
 */
    Flight::route("GET /users",function(){
        Flight::json(Flight::userService()->get_all());  
    });




/**
 * @OA\Get(path="/users/{id}", tags={"Users"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return user by ID",
 *     @OA\Parameter(in="path", name="id", example=27, description="User ID", required=true),
 *     @OA\Response(response="200", description="Fetch user by ID")
 * )
 */
    Flight::route("GET /users/@id", function($id){
        Flight::json(Flight::userService()->get_by_id($id));
    });


    Flight::route("GET /profile/@id", function($id){
        Flight::json(Flight::userService()->get_profile_info($id));
    });

    Flight::route("POST /profile/image-change/@userid", function($userid){
        $image = Flight::request()->files->getData()['image'];
        Flight::userService()->update_profile_picture($userid, $image);
    });





/**
 * @OA\Get(path="/usersById", tags={"Users"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return user by ID in body",
 *     @OA\Parameter(in="query", name="id", example=27, description="Blog ID", required=true),
 *     @OA\Response(response="200", description="Fetch user by ID")
 * )
 */
    Flight::route("GET /usersById", function(){
        Flight::json(Flight::userService()->get_by_id(Flight::request()->query['id']));
    });




/**
 * @OA\Delete(path="/users/{id}", tags={"Users"}, security={{"ApiKeyAuth": {}}},
 *     summary="Delete user",
 *     @OA\Parameter(in="path", name="id", example=4, description="User ID", required=true),
 *     @OA\Response(response="200", description="Deleted user by ID")
 * )
 */
    Flight::route("DELETE /users/@id", function($id){
        Flight::userService()->delete($id);
        Flight::json(['message'=>'User by id ' . $id . ' has been deleted.']);
    });





/**
 * @OA\Get(path="/numberofusers", tags={"Users"}, security={{"ApiKeyAuth": {}}},
 *         summary="Number of users (admin panel)",
 *         @OA\Response( response=200, description="Fetched the number.")
 * )
 */
    Flight::route("GET /numberofusers",function (){
        Flight::json(Flight::userService()->get_number_of_users());
    });





/**
 * @OA\Post(path="/users", tags={"Users"}, description="Add a new user", security={{"ApiKeyAuth": {}}},
 *     @OA\RequestBody(required=true, description="New user details",
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(required={"id","first_name", "last_name", "email", "password", "age"},
 *                 @OA\Property(property="id", type="integer", example="4"),
 *                 @OA\Property(property="first_name", type="string", example="Esma"),
 *                 @OA\Property(property="last_name", type="string", example="Duhovic"),
 *                 @OA\Property(property="email", type="string", example="esmad@gmail.com"),
 *                 @OA\Property(property="password", type="string", example="12345678"),
 *                 @OA\Property(property="age", type="integer", example=17)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User successfully added"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
    Flight::route("POST /users", function(){
        $data = Flight::request()->data->getData();
        $response = Flight::userService()->add($data);
        Flight::json(['message'=>'User added sucessfully.']);
        
    });


/**
 * @OA\Put(path="/users/{id}", tags={"Users"}, description="Update a user", security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=5, description="ID of the user to update", required=true),
 *     @OA\RequestBody(required=true, description="User details to update",
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(required={"first_name", "last_name", "email", "password", "age"},
 *                 @OA\Property(property="first_name", type="string", example="Dala"),
 *                 @OA\Property(property="last_name", type="string", example="Bejtovic"),
 *                 @OA\Property(property="email", type="string", example="dala@gmail.com"),
 *                 @OA\Property(property="password", type="string", example="12345678"),
 *                 @OA\Property(property="age", type="integer", example=19)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User has been successfully updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
    Flight::route("PUT /profile/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::userService()->updateProfileData($data,$id);
    });

    Flight::route("PUT /profile/change-password/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::userService()->changePassword($data, $id);
    });

    Flight::route("GET /admin/all-users", function (){
        Flight::userService()->get_users_for_admin();
    });

    Flight::route("PUT /admin/ban-user/@user_id", function ($user_id){
        Flight::userService()->ban_user($user_id);
    });

    Flight::route("PUT /admin/unban-user/@user_id", function ($user_id){
        Flight::userService()->unban_user($user_id);
    });


/**
 * @OA\Post(path="/login", tags={"Login and Register"}, description="Login to account", security={{"ApiKeyAuth": {}}},
 *     @OA\RequestBody(required=true, description="Login details",
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(required={"email", "password"},
 *                 @OA\Property(property="email", type="string", example="esmad@gmail.com"),
 *                 @OA\Property(property="password", type="string", example="12345678"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Login successful"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
    Flight::route("POST /login", function(){
        $login = Flight::request()->data->getData();
        $user = Flight::userService()->getUserByEmail($login['email']);
        if(isset($user['id'])){
            if($user['banned'] == 0){
                if($user['password'] == md5($login['password'])){
                    unset($user['password']);
                    unset($user['first_name']);
                    unset($user['last_name']);
                    unset($user['age']);
                    if($user['admin'] == 1){
                        $user['admin'] = true;
                    }
                    else{
                        $user['admin'] = false;
                    }
                    $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
                    Flight::json(['token'=> $jwt]);
                } else{
                    Flight::json(["message" => "Wrong password"], 404);
                }
            } else {
                Flight::json(["message"=>"Your account has been banned."], 409);
            }
        } else{
            Flight::json(["message" => "User doesn't exist"], 404);
        }
    });


/**
 * @OA\Post(path="/register", tags={"Login and Register"}, description="Register new account", security={{"ApiKeyAuth": {}}},
 *     @OA\RequestBody(required=true, description="New user details",
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(required={"first_name", "last_name", "email", "password","password2", "age"},
 *                 @OA\Property(property="first_name", type="string", example="Tare"),
 *                 @OA\Property(property="last_name", type="string", example="Tarik"),
 *                 @OA\Property(property="email", type="string", example="taretare@gmail.com"),
 *                 @OA\Property(property="password", type="string", example="12345678"),
 *                 @OA\Property(property="password2", type="string", example="12345678"),
 *                 @OA\Property(property="age", type="integer", example=17)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Account successfully created"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
    Flight::route("POST /register",  function (){
        $data = Flight::request()->data->getData();
        $response = Flight::userService()->add($data);
        Flight::json(['message'=>'User added sucessfully.']);
    });
