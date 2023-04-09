<?php
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



?>