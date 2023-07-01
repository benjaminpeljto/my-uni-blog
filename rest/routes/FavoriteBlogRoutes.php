<?php

Flight::route("GET /favoriteblogs/@userid", function ($userId){
    Flight::json(Flight::favoriteService()->get_favorites_by_user($userId));
});

Flight::route("POST /favoriteblog", function(){
    $data = Flight::request()->data->getData();
    $response = Flight::favoriteService()->add($data);
    Flight::json(['message' => 'favorite added', 'Data: ' => $response]);
});