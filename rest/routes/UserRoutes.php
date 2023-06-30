<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;


    Flight::route("GET /users",function(){
        Flight::json(Flight::userService()->get_all());  
    });

    Flight::route("GET /users/@id", function($id){
        Flight::json(Flight::userService()->get_by_id($id));
    });

    Flight::route("GET /usersById", function(){
        Flight::json(Flight::userService()->get_by_id(Flight::request()->query['id']));
    });

    Flight::route("DELETE /users/@id", function($id){
        Flight::userService()->delete($id);
        Flight::json(['message'=>'User by id ' . $id . ' has been deleted.']);
    });

    Flight::route("POST /users", function(){
        $data = Flight::request()->data->getData();
        $response = Flight::userService()->add($data);
        Flight::json(['message'=>'User added sucessfully.','Data: ' => $response]);
        
    });

    Flight::route("PUT /users/@id", function($id){
        $data = Flight::request()->data->getData();
        $response = Flight::userService()->update($data,$id);
        Flight::json(['message'=>'Updated user with new data.','Data'=> $response]);
    });

    Flight::route("POST /login", function(){
        $login = Flight::request()->data->getData();
        $user = Flight::userService()->getUserByEmail($login['email']);
        if(isset($user['id'])){
            if($user['password'] == md5($login['password'])){
                unset($user['password']);
                $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
                Flight::json(['token'=> $jwt]);
            } else{
                Flight::json(["message" => "Wrong password"], 404);
            }
        } else{
            Flight::json(["message" => "User doesn't exist"], 404);
        }
    });


?>