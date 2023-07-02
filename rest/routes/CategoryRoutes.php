<?php
    Flight::route("GET /category/@id", function ($id){
        Flight::json(Flight::categoryService()->get_blogs_by_category($id));
    });