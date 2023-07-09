<?php

Flight::route("GET /featuredblogs", function (){
    Flight::json(Flight::featuredService()->get_featured_blogs_with_user());
});

Flight::route("POST /featuredblog", function(){
    $data = Flight::request()->data->getData();
    $response = Flight::featuredService()->add($data);
    Flight::json(['message' => 'featured blog added', 'Data: ' => $response]);
});

Flight::route("DELETE /featuredblog/@id", function ($id){
    Flight::featuredService()->removefromfeatured($id);
    Flight::json(['message'=>'Blog removed from featured.']);
});